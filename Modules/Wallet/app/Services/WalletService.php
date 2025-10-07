<?php

namespace Modules\Wallet\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Exceptions\ValidationException;
use Modules\Sms\Sms;
use Modules\Wallet\Enums\WalletTransactionType;
use Modules\Wallet\Models\Wallet;

class WalletService
{
	private Wallet $wallet;

	public function __construct(private readonly Model $model)
	{
		$this->wallet = $this->model->wallet;
	}

	public function deposit(int $amount, string $description, bool $depositGiftBalance = false, bool $sendSms = false): void
	{
		$this->updateBalance($amount, $depositGiftBalance);
		$this->createTransaction($amount, $description, WalletTransactionType::DEPOSIT);

		if ($sendSms) {
			$this->sendSms(WalletTransactionType::DEPOSIT, $amount);
		}
	}

	public function withdraw(int $amount, string $description, bool $withdrawGiftBalanceToo = false, bool $sendSms = false): void
	{
		$maxAllowedAmount = $withdrawGiftBalanceToo ? $this->wallet->balance : $this->wallet->main_balance;

		if ($amount > $maxAllowedAmount) {
			throw new ValidationException('مبلغ درخواستی بیشتر از موجودی کاربر است');
		}

		$this->deductBalance($amount);
		$this->createTransaction($amount, $description, WalletTransactionType::WITHDRAW);

		if ($sendSms) {
			$this->sendSms(WalletTransactionType::WITHDRAW, $amount);
		}
	}

	private function updateBalance(int $amount, bool $isGift): void
	{
		if ($isGift) {
			$this->wallet->gift_balance += $amount;
		} else {
			$this->wallet->main_balance += $amount;
		}
		$this->wallet->save();
	}

	private function deductBalance(int $amount): void
	{
		if ($amount > $this->wallet->main_balance) {
			$diff = $amount - $this->wallet->main_balance;
			$this->wallet->main_balance = 0;
			$this->wallet->gift_balance -= $diff;
		} else {
			$this->wallet->main_balance -= $amount;
		}
		$this->wallet->save();
	}

	private function createTransaction(int $amount, string $description, WalletTransactionType $type): void
	{
		$this->wallet->transactions()->create([
			'amount' => $amount,
			'description' => $description,
			'type' => $type,
		]);
	}

	private function sendSms(WalletTransactionType $type, int $amount)
	{
		$key = match ($type) {
			WalletTransactionType::DEPOSIT => 'deposit_wallet',
			WalletTransactionType::WITHDRAW => 'withdraw_wallet',
		};

		if (app()->isProduction()) {
			$pattern = config('sms-patterns.' . $key);
			Sms::pattern($pattern)
				->data([
					'token' => number_format($amount),
					'token1' => $this->model->holder_name,
				])
				->to([$this->model->holder_mobile])
				->send();
		}
	}
}

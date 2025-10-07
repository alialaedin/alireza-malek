<?php

namespace Modules\Wallet\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Wallet\Enums\WalletTransactionType;
use Modules\Wallet\Models\Wallet;
use Modules\Wallet\Models\WalletTransaction;
use Modules\Wallet\Services\WalletService;

trait HasWallet
{
  public static function bootHasWallet(): void
  {
    static::created(function (Model $model) {
      Wallet::create([
        'holder_id' => $model->id,
        'holder_type' => $model,
      ]);
    });
  }

  public function initializeHasWallet(): void
  {
    $this->append('balance');
  }

  protected function balance(): Attribute
  {
    return Attribute::make(
      get: fn(): int => $this->wallet->balance
    );
  }

  public function deposit(int $amount, string $description, bool $depositGiftBalance = false, bool $sendSms = false): void
  {
    $service = new WalletService($this);
    $service->deposit(
      $amount,
      $description,
      $depositGiftBalance,
      $sendSms,
    );
  }

  public function withdraw(int $amount, string $description, bool $withdrawGiftBalanceToo = false, bool $sendSms = false)
  {
    $service = new WalletService($this);
    $service->withdraw(
      $amount,
      $description,
      $withdrawGiftBalanceToo,
      $sendSms,
    );
  }

  public function wallet(): MorphOne
  {
    return $this->morphOne(Wallet::class, 'holder');
  }

  public function walletTransactions(): HasManyThrough
  {
    return $this->hasManyThrough(WalletTransaction::class, Wallet::class);
  }

  public function deposits(): HasManyThrough
  {
    return $this->walletTransactions()->where('type', WalletTransactionType::DEPOSIT);
  }

  public function withdraws(): HasManyThrough
  {
    return $this->walletTransactions()->where('type', WalletTransactionType::WITHDRAW);
  }

  abstract protected function holderName(): Attribute;
  abstract protected function holderMobile(): Attribute;
}

<?php

namespace Modules\Wallet\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Company\Models\Company;
use Modules\Wallet\Http\Requests\Admin\WalletDepositRequest;
use Modules\Wallet\Http\Requests\Admin\WalletWithdrawRequest;

class WalletController extends Controller 
{
	public function deposit(WalletDepositRequest $request)
	{
		$comoany = Company::findOrFail($request->company_id);
		$comoany->deposit(
			$request->input('amount'),
			$request->input('description'),
			$request->boolean('deposit_gift_balance'),
			$request->boolean('send_sms'),
		);

		return redirect()->back()->with('status', 'موجودی کیف پول با موفقیت افزایش یافت');
	}

	public function withdraw(WalletWithdrawRequest $request)
	{
		$comoany = Company::findOrFail($request->company_id);
		$comoany->withdraw(
			$request->input('amount'),
			$request->input('description'),
			$request->boolean('withrdaw_gift_balance_too'),
			$request->boolean('send_sms'),
		);

		return redirect()->back()->with('status', 'موجودی کیف پول با موفقیت کاهش یافت');
	}
}

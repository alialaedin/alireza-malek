<?php

namespace Modules\Account\Http\Controllers\Company;

use Modules\Account\Http\Requests\Company\AccountStoreRequest;
use Modules\Account\Http\Requests\Company\AccountUpdateRequest;
use Modules\Account\Models\Account;
use Modules\Company\Http\Controllers\Company\BaseCompanyController;

class AccountController extends BaseCompanyController
{
	public function index()
	{
		$accounts = Account::query()->latest()->get();

		return view('account::company.index', compact('accounts'));
	}

	public function create()
	{
		return view('account::company.create');
	}

	public function store(AccountStoreRequest $request)
	{
		Account::create($request->validated());

		return to_route('company.accounts.index')->with('status', 'حساب بانکی با موفقیت ایجاد شد');
	}

	public function edit(Account $account)
	{
		return view('account::company.edit', compact('account'));
	}

	public function update(AccountUpdateRequest $request, Account $account)
	{
		$account->update($request->validated());

		return to_route('company.accounts.index')->with('status', 'حساب بانکی با موفقیت بروزرسانی شد');
	}

	public function destroy(Account $account)
	{
		$account->delete();

		return to_route('company.accounts.index')->with('status', 'حساب بانکی با موفقیت حذف شد');
	}
}

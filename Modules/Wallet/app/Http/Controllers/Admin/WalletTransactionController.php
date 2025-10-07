<?php

namespace Modules\Wallet\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Company\Models\Company;
use Modules\Wallet\Models\WalletTransaction;

class WalletTransactionController extends Controller
{
	public function index()
	{
		$filters = WalletTransaction::getFilterInputs();
		$companies = Company::getAllCompanies();

		$walletTransactions = WalletTransaction::query()
			->with([
				'wallet:id,holder_id,holder_type',
				'wallet.holder'
			])
			->filters()
			->latest()
			->paginate()
			->withQueryString();

		return view('wallet::admin.transactions', compact(['walletTransactions', 'filters', 'companies']));
	}
}

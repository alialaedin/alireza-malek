<?php

namespace Modules\Company\Http\Controllers\Company;

use Modules\Company\Http\Requests\Company\Finance\FinanceStoreRequest;
use Modules\Company\Http\Requests\Company\Finance\FinanceUpdateRequest;
use Modules\Company\Models\Finance;

class FinanceController extends BaseCompanyController
{
	public function index()
	{
		$finances = Finance::query()->latest()->filters()->get();
		$filters = Finance::getFilterInputs();

		return view('company::company.finance.index', compact(['finances', 'filters']));
	}

	public function create()
	{
		return view('company::company.finance.create');
	}

	public function store(FinanceStoreRequest $request)
	{
		Finance::query()->insert($request->finances);

		return to_route('company.finances.index')->with('status', 'دارایی با موفقیت ایجاد شد');
	}

	public function edit(Finance $finance)
	{
		return view('company::company.finance.edit', compact('finance'));
	}

	public function update(FinanceUpdateRequest $request, Finance $finance)
	{
		$finance->update($request->validated());

		return to_route('company.finances.index')->with('status', 'دارایی با موفقیت بروزرسانی شد');
	}

	public function destroy(Finance $finance)
	{
		$finance->delete();

		return to_route('company.finances.index')->with('status', 'دارایی با موفقیت بروزرسانی شد');
	}
}

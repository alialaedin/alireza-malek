<?php

namespace Modules\Accounting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Accounting\Enums\HeadlineType;
use Modules\Accounting\Http\Requests\Admin\ExpenseStoreRequest;
use Modules\Accounting\Http\Requests\Admin\ExpenseUpdateRequest;
use Modules\Accounting\Models\Expense;
use Modules\Accounting\Models\Headline;

class ExpenseController extends Controller 
{
	public function index(): View
	{
		$expenses = Expense::query()->latest()->filters()->paginateOrAll();
		$filters = Expense::getFilterInputs();

		return view('accounting::admin.expense.index', compact(['filters', 'expenses']));
	}

	public function create()
	{
		$headlines = Headline::getAllByType(HeadlineType::EXPENSE);

		return view('accounting::admin.expense.create', compact('headlines'));
	}

	public function store(ExpenseStoreRequest $request): RedirectResponse
	{
		Expense::create($request->validated());

		return to_route('admin.expenses.index')->with('status', 'هزینه با موفقیت ثبت شد');
	}

	public function edit(Expense $expense): View
	{
		$headlines = Headline::getAllByType(HeadlineType::EXPENSE);

		return view('accounting::admin.expense.edit', compact(['headlines', 'expense']));
	}

	public function update(ExpenseUpdateRequest $request, Expense $expense): RedirectResponse
	{
		$expense->update($request->validated());

		return to_route('admin.expenses.index')->with('status', 'هزینه با موفقیت بروز شد');
	}

	public function destroy(Expense $expense): RedirectResponse
	{
		$expense->delete();

		return to_route('admin.expenses.index')->with('status', 'هزینه با موفقیت حذف شد');
	}
}

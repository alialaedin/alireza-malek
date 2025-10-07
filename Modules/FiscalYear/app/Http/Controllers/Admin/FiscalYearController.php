<?php

namespace Modules\FiscalYear\Http\Controllers\Admin;

use Modules\Company\Http\Controllers\Company\BaseCompanyController;
use Modules\FiscalYear\Http\Requests\Admin\FiscalYearStoreRequest;
use Modules\FiscalYear\Http\Requests\Admin\FiscalYearUpdateRequest;
use Modules\FiscalYear\Models\FiscalYear;

class FiscalYearController extends BaseCompanyController
{
	public function index()
	{
		$fiscalYears = FiscalYear::getAll();

		return view('fiscalyear::admin.index', compact('fiscalYears'));
	}

	public function store(FiscalYearStoreRequest $request)
	{
		FiscalYear::create($request->validated());

		return to_route('admin.fiscal-years.index')->with('status', 'سال مالی با موفقیت ایجاد شد');
	}

	public function update(FiscalYearUpdateRequest $request, FiscalYear $fiscalYear)
	{
		$fiscalYear->update($request->validated());

		return to_route('admin.fiscal-years.index')->with('status', 'سال مالی با موفقیت بروزرسانی شد');
	}

	public function destroy(FiscalYear $fiscalYear)
	{
		$fiscalYear->delete();

		return to_route('admin.fiscal-years.index')->with('status', 'سال مالی با موفقیت حذف شد');
	}
}

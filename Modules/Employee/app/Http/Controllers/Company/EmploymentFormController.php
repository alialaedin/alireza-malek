<?php

namespace Modules\Employee\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Modules\Employee\Events\EmploymentFormCreated;
use Modules\Employee\Http\Requests\Company\EmploymentFormStoreRequest;
use Modules\Employee\Models\EmploymentForm;

class EmploymentFormController extends Controller
{
	public function index()
	{
		$employmentForms = EmploymentForm::query()->latest()->filters()->paginate()->withQueryString();
		$filters = EmploymentForm::getFilterInputs();

		return view('employee::company.employment-form.index', compact(['employmentForms', 'filters']));
	}

	public function store(EmploymentFormStoreRequest $request)
	{
		$employmentForm = EmploymentForm::create($request->validated());
		EmploymentFormCreated::dispatch($employmentForm);

		return redirect()->back()->with('status', 'لینک فرم با موفقیت ارسال شد');
	}

	public function destroy(EmploymentForm $employment)
	{
		$employment->delete();

		return redirect()->back()->with('status', 'لینک فرم با موفقیت حذف شد');
	}
}

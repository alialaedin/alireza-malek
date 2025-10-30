<?php

namespace Modules\Employee\Http\Controllers\Company;

use Modules\Company\Http\Controllers\Company\BaseCompanyController;
use Modules\Employee\Models\Employee;
use Modules\Employee\Services\EmployeeCollection;

class EmployeeController extends BaseCompanyController
{
	public function index()
	{
		$filters = Employee::getFilterInputs();
		$employees = EmployeeCollection::paginated();

		return view('employee::company.employee.index', compact(['employees', 'filters']));
	}
}

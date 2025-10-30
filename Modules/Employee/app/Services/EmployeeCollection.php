<?php

namespace Modules\Employee\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Employee\Models\Employee;

class EmployeeCollection
{
	public static function paginated(): LengthAwarePaginator
	{
		return Employee::query()
			->select(['id', 'first_name', 'last_name', 'mobile', 'employment_form_id', 'can_login', 'created_at'])
			->latest()
			->with('employmentForm:id,status')
			->filters()
			->paginate()
			->withQueryString();
	}
}

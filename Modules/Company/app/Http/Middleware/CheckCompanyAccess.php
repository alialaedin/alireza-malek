<?php

namespace Modules\Company\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Enums\GuardName;

class CheckCompanyAccess
{
	public function handle(Request $request, Closure $next)
	{
		$company = Auth::guard(GuardName::COMPANY->value)->user();

		if (!$company) {
			abort(403, 'Unauthorized');
		}
		
		foreach ($request->route()->parameters() as $param) {
			if (is_object($param) && $param instanceof Model) {
				if ($param->getAttribute('company_id') !== null) {
					if ($param->company_id != $company->id) {
						abort(403, 'You do not have permission to access this resource.');
					}
				}
			}
		}

		return $next($request);
	}
}

<?php

namespace Modules\Company\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Company\Http\Middleware\CheckCompanyAccess;

abstract class BaseCompanyController extends Controller implements HasMiddleware
{
	protected static array $companyAccessMethods = [];

	public static function middleware(): array
	{
		$baseMethods = ['edit', 'update', 'show', 'destroy'];
		$methods = array_merge($baseMethods, static::$companyAccessMethods);
		$existingMethods = [];

		foreach ($methods as $method) {
			if (method_exists(static::class, $method)) {
				$existingMethods[] = $method;
			}
		}

		return [
			new Middleware(CheckCompanyAccess::class, $existingMethods)
		];
	}
}

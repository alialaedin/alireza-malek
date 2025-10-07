<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Modules\Auth\Enums\GuardName;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		web: __DIR__ . '/../routes/web.php',
		commands: __DIR__ . '/../routes/console.php',
		health: '/up',
	)
	->withMiddleware(function (Middleware $middleware): void {

		$middleware->redirectGuestsTo(function (Request $request) {
			if (str_starts_with($request->path(), GuardName::ADMIN->value))
				return route('admin.login-form');
			if (str_starts_with($request->path(), GuardName::COMPANY->value))
				return route('company.login-form');
			if (str_starts_with($request->path(), GuardName::EMPLOYEE->value))
				return route('employee.login-form');
			return route('base-login-form');
		});

		$middleware->redirectUsersTo(function (Request $request) {
			if (auth(GuardName::ADMIN->value)->check())
				return route('admin.dashboard');
			if (auth(GuardName::COMPANY->value)->check())
				return route('company.dashboard');
			if (auth(GuardName::EMPLOYEE->value)->check())
				return route('employee.dashboard');
			abort(404);
		});
	})
	->withExceptions(function (Exceptions $exceptions): void {
		//
	})
	->withSchedule(function (Schedule $schedule) {
		//
	})
	->create();

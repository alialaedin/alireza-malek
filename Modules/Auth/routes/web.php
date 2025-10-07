<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Auth\Http\Controllers\Admin\AuthController as AdminAuthController;
use Modules\Auth\Http\Controllers\Company\AuthController as CompanyAuthController;
use Modules\Auth\Http\Controllers\Employee\AuthController as EmployeeAuthController;

$guards = [
	GuardName::ADMIN->value => AdminAuthController::class,
	GuardName::COMPANY->value => CompanyAuthController::class,
	GuardName::EMPLOYEE->value => EmployeeAuthController::class,
];

Route::middleware('guest')->group(function () use ($guards) {

	foreach ($guards as $prefix => $controller) {
		Route::prefix("$prefix/login")->name("$prefix.")->group(function () use ($controller) {
			Route::get('/', [$controller, 'showLoginForm'])->name('login-form');
			Route::post('/', [$controller, 'login'])->name('login');
		});
	}

	Route::view('/', 'auth::choose-login-guard')->name('base-login-form');
});

foreach ($guards as $guard => $controller) {
	Route::middleware("auth:$guard")
		->post("/$guard/logout", [$controller, 'logout'])
		->name("$guard.logout");
}

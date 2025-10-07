<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Dashboard\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Modules\Dashboard\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use Modules\Dashboard\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;

Route::superGroup(GuardName::ADMIN, function () {
	Route::redirect('/', '/'. GuardName::ADMIN->value .'/dashboard');
	Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

Route::superGroup(GuardName::COMPANY, function () {
	Route::redirect('/', '/'. GuardName::COMPANY->value .'/dashboard');
	Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
});

Route::superGroup(GuardName::EMPLOYEE, function () {
	Route::redirect('/', '/'. GuardName::EMPLOYEE->value .'/dashboard');
	Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');
});

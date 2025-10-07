<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Employee\Http\Controllers\Company\EmploymentFormController as CompanyEmploymentFormController;
use Modules\Employee\Http\Controllers\Employee\EmploymentFormController as EmployeeEmploymentFormController;

Route::superGroup(GuardName::COMPANY, function () {
	Route::resource('/employment-forms', CompanyEmploymentFormController::class)
		->except('create', 'edit', 'update', 'show');
});

Route::prefix('/register-employee/{employmentForm}')->name('employee.registration.')->group(function () {
	Route::get('/authentication-form', [EmployeeEmploymentFormController::class, 'showAuthenticationForm'])->name('show-authentication-form');
	Route::post('/send-authentication-token', [EmployeeEmploymentFormController::class, 'sendAuthenticationToken'])->name('send-authentication-token');
	Route::post('/authenticate', [EmployeeEmploymentFormController::class, 'authenticate'])->name('authenticate');
	Route::get('/register-form', [EmployeeEmploymentFormController::class, 'showRegisterForm'])->name('show-register-form');
	Route::post('/register', [EmployeeEmploymentFormController::class, 'register'])->name('register');
});

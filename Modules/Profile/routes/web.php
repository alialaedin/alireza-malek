<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Profile\Http\Controllers\AdminProfileController;
use Modules\Profile\Http\Controllers\CompanyProfileController;
use Modules\Profile\Http\Controllers\EmployeeProfileController;

Route::superGroup(GuardName::COMPANY, function () {
	Route::get('/profile', [CompanyProfileController::class, 'index'])->name('profile.index');
	Route::patch('/profile', [CompanyProfileController::class, 'update'])->name('profile.update');
});

Route::superGroup(GuardName::ADMIN, function () {
	Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
	Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
});

Route::superGroup(GuardName::EMPLOYEE, function () {
	Route::get('/profile', [EmployeeProfileController::class, 'index'])->name('profile.index');
	Route::patch('/profile', [EmployeeProfileController::class, 'update'])->name('profile.update');
});

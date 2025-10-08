<?php

use Illuminate\Support\Facades\Route;
use Modules\Activity\Http\Controllers\ActivityController;
use Modules\Auth\Enums\GuardName;

Route::superGroup(GuardName::ADMIN, function () {
	Route::get('/admin-activities', [ActivityController::class, 'admin'])->name('admin-activities');
	Route::get('/company-activities', [ActivityController::class, 'company'])->name('company-activities');
	Route::get('/employee-activities', [ActivityController::class, 'employee'])->name('employee-activities');
});

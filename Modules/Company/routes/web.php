<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Company\Http\Controllers\Admin\LegalCompanyController;
use Modules\Company\Http\Controllers\Admin\RealCompanyController;
use Modules\Company\Http\Controllers\Company\FinanceController;
use Modules\Company\Http\Controllers\Company\WorkplaceController;

Route::superGroup(GuardName::ADMIN, function () {
	Route::resource('/real-companies', RealCompanyController::class);
	Route::resource('/legal-companies', LegalCompanyController::class);
});

Route::superGroup(GuardName::COMPANY, function () {
	Route::resource('/finances', FinanceController::class)->except('show');
	Route::resource('/workplaces', WorkplaceController::class)->except('show');
});
<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Contract\Http\Controllers\Admin\ContractCompanyController;

Route::superGroup(GuardName::ADMIN, function () {
  Route::resource('/contract-companies', ContractCompanyController::class)->except('create');
  Route::get('/contract-companies/create/{type}', [ContractCompanyController::class, 'create'])->name('contract-companies.create');
});

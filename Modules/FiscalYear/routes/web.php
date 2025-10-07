<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\FiscalYear\Http\Controllers\Admin\FiscalYearController;

Route::superGroup(GuardName::ADMIN, function () {
	Route::resource('/fiscal-years', FiscalYearController::class)->except(['show', 'create', 'edit']);
});


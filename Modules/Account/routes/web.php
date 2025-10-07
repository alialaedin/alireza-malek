<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\Http\Controllers\Company\AccountController;
use Modules\Auth\Enums\GuardName;

Route::superGroup(GuardName::COMPANY, function () {
	Route::resource('/accounts', AccountController::class);
});
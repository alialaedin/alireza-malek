<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Job\Http\Controllers\Company\CompanyJobController;
use Modules\Job\Http\Controllers\Company\DutyController;

Route::superGroup(GuardName::COMPANY, function () {
  Route::resource('/jobs', CompanyJobController::class);
  Route::resource('/duties', DutyController::class)->except('show');
});

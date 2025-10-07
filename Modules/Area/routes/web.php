<?php

use Illuminate\Support\Facades\Route;
use Modules\Area\Http\Controllers\Admin\CityController;
use Modules\Area\Http\Controllers\Admin\ProvinceController;
use Modules\Auth\Enums\GuardName;

Route::superGroup(GuardName::ADMIN, function () {
  Route::resource('/provinces', ProvinceController::class);
  Route::resource('/cities', CityController::class);
});
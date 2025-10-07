<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Position\Http\Controllers\Admin\PositionController;

Route::superGroup(GuardName::ADMIN, function () {
	Route::resource('/positions', PositionController::class);
});

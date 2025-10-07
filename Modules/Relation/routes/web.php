<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Relation\Http\Controllers\Company\RelationController;

Route::superGroup(GuardName::COMPANY, function () {
	Route::resource('/relations', RelationController::class);
});

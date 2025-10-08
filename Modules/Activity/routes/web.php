<?php

use Illuminate\Support\Facades\Route;
use Modules\Activity\Http\Controllers\ActivityController;
use Modules\Auth\Enums\GuardName;

Route::superGroup(GuardName::ADMIN, function () {
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
});

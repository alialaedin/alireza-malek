<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Auth\Enums\GuardName;

Route::superGroup(GuardName::ADMIN, function () {
    Route::resource('/admins', AdminController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Language\Http\Controllers\Admin\LanguageController;

Route::superGroup(GuardName::ADMIN, function () {
	Route::resource('/languages', LanguageController::class)->except('show');
});

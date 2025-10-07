<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Setting\Http\Controllers\SettingController;

Route::superGroup(GuardName::ADMIN, function () {
	Route::prefix('/settings')->name('settings.')->group(function () {
		Route::get('/', [SettingController::class, 'index'])->name('index');
		Route::patch('/', [SettingController::class, 'update'])->name('update');
		Route::delete('/{setting}', [SettingController::class, 'deleteFile'])->name('delete-file');
	});
});

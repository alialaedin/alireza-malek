<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Campaign\Http\Controllers\Admin\CampaignController;

Route::superGroup(GuardName::ADMIN, function () {
  Route::resource('/campaigns', CampaignController::class);
});
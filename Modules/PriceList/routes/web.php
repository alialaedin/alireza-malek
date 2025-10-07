<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\PriceList\Http\Controllers\Company\PriceListController;

Route::superGroup(GuardName::COMPANY, function () {
	Route::resource('/price-lists', PriceListController::class)->except('show');
});

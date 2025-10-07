<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Enums\GuardName;
use Modules\Wallet\Http\Controllers\Admin\WalletController;
use Modules\Wallet\Http\Controllers\Admin\WalletTransactionController;

Route::superGroup(GuardName::ADMIN, function () {
	
	Route::prefix('/wallet-transactions')->name('wallet-transactions.')->group(function () {
		Route::get('/', [WalletTransactionController::class, 'index'])->name('index');
	});

	Route::prefix('/wallets')->name('wallets.')->group(function () {
		Route::post('/deposit', [WalletController::class, 'deposit'])->name('deposit');
		Route::post('/withdraw', [WalletController::class, 'withdraw'])->name('withdraw');
	});

});

<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranDeposit\Http\Controllers\PembayaranDepositController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pembayarandeposits', PembayaranDepositController::class)->names('pembayarandeposit');
});

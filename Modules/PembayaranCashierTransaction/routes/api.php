<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranCashierTransaction\Http\Controllers\CashierTransactionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('cashier-transactions', CashierTransactionController::class)->only(['index', 'store', 'show']);
});

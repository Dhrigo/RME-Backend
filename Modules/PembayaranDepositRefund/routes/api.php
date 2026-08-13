<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranDepositRefund\Http\Controllers\DepositRefundController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('deposit-refunds', DepositRefundController::class)->only(['index', 'store', 'show']);
});

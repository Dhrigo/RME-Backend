<?php

use Illuminate\Support\Facades\Route;
use Modules\PenjualanSaleReturn\Http\Controllers\SaleReturnController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sale-returns', SaleReturnController::class)->only(['index', 'store', 'show']);
});

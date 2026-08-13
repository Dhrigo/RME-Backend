<?php

use Illuminate\Support\Facades\Route;
use Modules\PenjualanSaleItem\Http\Controllers\SaleItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sale-items', SaleItemController::class)->only(['index', 'store', 'show']);
});

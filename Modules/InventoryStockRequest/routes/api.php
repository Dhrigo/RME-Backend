<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryStockRequest\Http\Controllers\StockRequestController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('stock-requests', StockRequestController::class)->only(['index', 'store', 'show', 'update']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryStockRequestItem\Http\Controllers\InventoryStockRequestItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('stock-request-items', InventoryStockRequestItemController::class)
        ->parameters(['stock-request-items' => 'stock_request_item'])
        ->only(['index', 'store', 'show']);
});

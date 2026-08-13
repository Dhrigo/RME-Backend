<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryWardStockTransaction\Http\Controllers\InventoryWardStockTransactionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ward-stock-transactions', InventoryWardStockTransactionController::class)
        ->parameters(['ward-stock-transactions' => 'ward_stock_transaction'])
        ->only(['index', 'store', 'show']);
});

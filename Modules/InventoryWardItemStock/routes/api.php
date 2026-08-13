<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryWardItemStock\Http\Controllers\InventoryWardItemStockController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inventorywarditemstocks', InventoryWardItemStockController::class)->names('inventorywarditemstock');
});

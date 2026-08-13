<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryMinimumStockLevel\Http\Controllers\InventoryMinimumStockLevelController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inventoryminimumstocklevels', InventoryMinimumStockLevelController::class)->names('inventoryminimumstocklevel');
});

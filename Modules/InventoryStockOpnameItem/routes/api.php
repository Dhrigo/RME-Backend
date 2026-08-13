<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryStockOpnameItem\Http\Controllers\InventoryStockOpnameItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inventorystockopnameitems', InventoryStockOpnameItemController::class)->names('inventorystockopnameitem')->only(['index', 'store', 'show']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryStockOpname\Http\Controllers\InventoryStockOpnameController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inventorystockopnames', InventoryStockOpnameController::class)->names('inventorystockopname')->only(['index', 'store', 'show', 'update']);
});

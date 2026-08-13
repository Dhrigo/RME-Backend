<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryItemPrice\Http\Controllers\InventoryItemPriceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inventoryitemprices', InventoryItemPriceController::class)->names('inventoryitemprice')->only(['index', 'store', 'show', 'update']);
});

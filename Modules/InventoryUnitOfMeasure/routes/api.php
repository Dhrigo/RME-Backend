<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryUnitOfMeasure\Http\Controllers\InventoryUnitOfMeasureController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inventoryunitofmeasures', InventoryUnitOfMeasureController::class)->names('inventoryunitofmeasure');
});

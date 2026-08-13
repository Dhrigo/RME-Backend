<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryShipment\Http\Controllers\ShipmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('shipments', ShipmentController::class)->only(['index', 'store', 'show', 'update']);
});

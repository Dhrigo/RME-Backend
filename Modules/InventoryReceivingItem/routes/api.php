<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryReceivingItem\Http\Controllers\ReceivingItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('receiving-items', ReceivingItemController::class)->only(['index', 'store', 'show']);
});

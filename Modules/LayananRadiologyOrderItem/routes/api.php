<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananRadiologyOrderItem\Http\Controllers\RadiologyOrderItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('radiology-order-items', RadiologyOrderItemController::class)->only(['index', 'store', 'show'])->parameters(['radiology-order-items' => 'rad_order_item']);
});

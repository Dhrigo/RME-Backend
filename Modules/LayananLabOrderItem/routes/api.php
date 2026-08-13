<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabOrderItem\Http\Controllers\LabOrderItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-order-items', LabOrderItemController::class)->only(['index', 'store', 'show'])->parameters(['lab-order-items' => 'lab_order_item']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananRadiologyOrder\Http\Controllers\RadiologyOrderController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('radiology-orders', RadiologyOrderController::class)->only(['index', 'store', 'show', 'update'])->parameters(['radiology-orders' => 'rad_order']);
});

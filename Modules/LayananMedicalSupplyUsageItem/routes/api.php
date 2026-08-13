<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananMedicalSupplyUsageItem\Http\Controllers\MedicalSupplyUsageItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medical-supply-usage-items', MedicalSupplyUsageItemController::class)->only(['index', 'store', 'show'])->parameters(['medical-supply-usage-items' => 'supply_usage_item']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananMedicalSupplyUsage\Http\Controllers\MedicalSupplyUsageController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medical-supply-usages', MedicalSupplyUsageController::class)->only(['index', 'store', 'show', 'update'])->parameters(['medical-supply-usages' => 'supply_usage']);
});

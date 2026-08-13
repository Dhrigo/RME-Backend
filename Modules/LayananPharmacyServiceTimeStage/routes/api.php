<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPharmacyServiceTimeStage\Http\Controllers\PharmacyServiceTimeStageController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-service-time-stages', PharmacyServiceTimeStageController::class)->only(['index', 'store', 'show', 'destroy'])->parameters(['pharmacy-service-time-stages' => 'record']);
});

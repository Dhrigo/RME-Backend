<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDischargePlanningRiskFactor\Http\Controllers\DischargePlanningRiskFactorController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('discharge-planning-risk-factors', DischargePlanningRiskFactorController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['discharge-planning-risk-factors' => 'record']);
});

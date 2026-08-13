<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordRiskFactor\Http\Controllers\RiskFactorController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('risk-factors', RiskFactorController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['risk-factors' => 'record']);
});

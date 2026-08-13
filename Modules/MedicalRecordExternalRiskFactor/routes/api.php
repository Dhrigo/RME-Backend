<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordExternalRiskFactor\Http\Controllers\ExternalRiskFactorController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('external-risk-factors', ExternalRiskFactorController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['external-risk-factors' => 'record']);
});

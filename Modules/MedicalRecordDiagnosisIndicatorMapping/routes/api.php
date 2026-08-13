<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDiagnosisIndicatorMapping\Http\Controllers\DiagnosisIndicatorMappingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('diagnosis-indicator-mappings', DiagnosisIndicatorMappingController::class)
        ->parameters(['diagnosis-indicator-mappings' => 'record']);
});

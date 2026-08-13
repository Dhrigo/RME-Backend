<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDifferentialDiagnosis\Http\Controllers\DifferentialDiagnosisController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('differential-diagnoses', DifferentialDiagnosisController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['differential-diagnoses' => 'record']);
});

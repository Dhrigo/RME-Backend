<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordNursingDiagnosis\Http\Controllers\NursingDiagnosisController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nursing-diagnoses', NursingDiagnosisController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['nursing-diagnoses' => 'record']);
});

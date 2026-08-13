<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPharmacyDiagnosis\Http\Controllers\PharmacyDiagnosisController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-diagnoses', PharmacyDiagnosisController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['pharmacy-diagnoses' => 'record']);
});

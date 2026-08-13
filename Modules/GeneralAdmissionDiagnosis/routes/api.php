<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralAdmissionDiagnosis\Http\Controllers\AdmissionDiagnosisController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('admission-diagnoses', AdmissionDiagnosisController::class);
});

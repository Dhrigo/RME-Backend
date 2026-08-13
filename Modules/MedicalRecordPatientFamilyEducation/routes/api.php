<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPatientFamilyEducation\Http\Controllers\PatientFamilyEducationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-family-educations', PatientFamilyEducationController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['patient-family-educations' => 'record']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientFamily\Http\Controllers\PatientFamilyController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-families', PatientFamilyController::class)
        ->names('generalpatientfamily.patient-families');
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranPatientPurpose\Http\Controllers\PatientPurposeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-purposes', PatientPurposeController::class);
});
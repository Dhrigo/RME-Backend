<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranPatientGuardianIdentityCard\Http\Controllers\PatientGuardianIdentityCardController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-guardian-identity-cards', PatientGuardianIdentityCardController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientFamilyIdentityCard\Http\Controllers\PatientFamilyIdentityCardController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-family-identity-cards', PatientFamilyIdentityCardController::class)
        ->names('generalpatientfamilyidentitycard.patient-family-identity-cards');
});

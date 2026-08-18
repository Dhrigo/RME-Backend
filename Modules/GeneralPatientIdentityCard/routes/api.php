<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientIdentityCard\Http\Controllers\PatientIdentityCardController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-identity-cards', PatientIdentityCardController::class);
});

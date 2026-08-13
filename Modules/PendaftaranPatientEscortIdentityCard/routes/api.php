<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranPatientEscortIdentityCard\Http\Controllers\PatientEscortIdentityCardController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-escort-identity-cards', PatientEscortIdentityCardController::class);
});

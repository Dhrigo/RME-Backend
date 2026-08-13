<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranPatientEscort\Http\Controllers\PatientEscortController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-escorts', PatientEscortController::class);
});

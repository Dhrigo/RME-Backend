<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranPatientEscortContact\Http\Controllers\PatientEscortContactController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-escort-contacts', PatientEscortContactController::class);
});

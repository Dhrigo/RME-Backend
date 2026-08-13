<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientContact\Http\Controllers\PatientContactController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-contacts', PatientContactController::class);
});

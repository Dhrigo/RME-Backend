<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientFamilyContact\Http\Controllers\PatientFamilyContactController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-family-contacts', PatientFamilyContactController::class)
        ->names('generalpatientfamilycontact.patient-family-contacts');
});

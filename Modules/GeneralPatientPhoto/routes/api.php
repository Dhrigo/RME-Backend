<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientPhoto\Http\Controllers\GeneralPatientPhotoController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-photos', GeneralPatientPhotoController::class)->parameters(['patient-photos' => 'patientPhoto']);
});

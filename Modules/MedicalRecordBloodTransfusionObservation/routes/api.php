<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBloodTransfusionObservation\Http\Controllers\BloodTransfusionObservationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('blood-transfusion-observations', BloodTransfusionObservationController::class)
        ->parameters(['blood-transfusion-observations' => 'record']);
});

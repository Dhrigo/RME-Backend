<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordEmergencyEducation\Http\Controllers\EmergencyEducationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('emergency-educations', EmergencyEducationController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['emergency-educations' => 'record']);
});

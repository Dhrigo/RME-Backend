<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatient\Http\Controllers\PatientController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patients', PatientController::class);
});

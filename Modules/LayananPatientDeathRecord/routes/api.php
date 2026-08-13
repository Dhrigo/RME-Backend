<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPatientDeathRecord\Http\Controllers\PatientDeathRecordController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-death-records', PatientDeathRecordController::class)->only(['index', 'store', 'show', 'update'])->parameters(['patient-death-records' => 'death_record']);
});

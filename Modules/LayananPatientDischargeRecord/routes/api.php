<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPatientDischargeRecord\Http\Controllers\PatientDischargeRecordController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-discharge-records', PatientDischargeRecordController::class)->only(['index', 'store', 'show', 'update'])->parameters(['patient-discharge-records' => 'discharge_record']);
});

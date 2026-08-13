<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranPatientReceivable\Http\Controllers\PatientReceivableController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-receivables', PatientReceivableController::class)->only(['index', 'store', 'show', 'update']);
});

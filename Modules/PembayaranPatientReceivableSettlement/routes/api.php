<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranPatientReceivableSettlement\Http\Controllers\PatientReceivableSettlementController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-receivable-settlements', PatientReceivableSettlementController::class)->only(['index', 'store', 'show']);
});

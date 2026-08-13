<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Http\Controllers\ProcedureConsentPatientAcknowledgementController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('procedure-consent-patient-acks', ProcedureConsentPatientAcknowledgementController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['procedure-consent-patient-acks' => 'record']);
});

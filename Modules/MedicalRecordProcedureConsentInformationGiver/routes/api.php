<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordProcedureConsentInformationGiver\Http\Controllers\ProcedureConsentInformationGiverController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('procedure-consent-information-givers', ProcedureConsentInformationGiverController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['procedure-consent-information-givers' => 'record']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatIgd\Http\Controllers\EncounterController;
use Modules\SatuSehatIgd\Http\Controllers\TriageObservationController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/igd')->group(function () {
    // Pendaftaran Kunjungan IGD - POST Encounter (class.code=EMER).
    Route::post('encounters', [EncounterController::class, 'store']);
    // Data Triase - POST Observation (LOINC 75910-0 CTAS).
    Route::post('triage-observations', [TriageObservationController::class, 'store']);
});

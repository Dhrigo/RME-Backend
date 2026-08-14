<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatFarmasi\Http\Controllers\MedicationRequestController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/farmasi')->group(function () {
    // Peresepan Obat oleh Fasyankes - POST MedicationRequest (+ inline Medication, KFA code).
    Route::post('medication-requests', [MedicationRequestController::class, 'store']);
});

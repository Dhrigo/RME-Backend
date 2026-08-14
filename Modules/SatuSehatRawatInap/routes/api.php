<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatRawatInap\Http\Controllers\EncounterController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/rawat-inap')->group(function () {
    // Pendaftaran/Masuk Kunjungan Rawat Inap - POST Encounter (class.code=IMP).
    Route::post('encounters', [EncounterController::class, 'store']);
});

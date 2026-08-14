<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatRawatJalan\Http\Controllers\EncounterController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/rawat-jalan')->group(function () {
    // Pendaftaran Kunjungan Rawat Jalan - POST Encounter (class.code=AMB).
    Route::post('encounters', [EncounterController::class, 'store']);
});

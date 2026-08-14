<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatKlaim\Http\Controllers\SatuSehatKlaimController;

Route::middleware(['auth:sanctum'])->prefix('v1/satu-sehat-klaim')->group(function () {
    Route::get('/', [SatuSehatKlaimController::class, 'index']);
    Route::get('{klaimSubmission}', [SatuSehatKlaimController::class, 'show']);
    Route::post('{useCase}', [SatuSehatKlaimController::class, 'store'])->whereIn('useCase', [
        'swasta_primary_payor', 'swasta_secondary_payor', 'swasta_tpa', 'swasta_oop', 'bpjsk', 'rujukan_pasien',
    ]);
});

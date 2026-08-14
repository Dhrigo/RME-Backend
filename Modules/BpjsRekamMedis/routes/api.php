<?php

use Illuminate\Support\Facades\Route;
use Modules\BpjsRekamMedis\Http\Controllers\KlaimController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // Submit medical record bundle for a SEP (SmartClaim rekammedis/insert flow).
    Route::post('klaims', [KlaimController::class, 'store']);
    Route::get('klaims/{klaim}', [KlaimController::class, 'show']);
});

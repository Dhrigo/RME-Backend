<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatSpesialistik\Http\Controllers\SatuSehatSpesialistikController;

Route::middleware(['auth:sanctum'])->prefix('v1/satu-sehat-spesialistik')->group(function () {
    Route::get('/', [SatuSehatSpesialistikController::class, 'index']);
    Route::get('{spesialistikSubmission}', [SatuSehatSpesialistikController::class, 'show']);
    Route::post('{useCase}', [SatuSehatSpesialistikController::class, 'store'])->whereIn('useCase', ['gigi', 'mata', 'telinga', 'geriatri', 'ubm']);
});

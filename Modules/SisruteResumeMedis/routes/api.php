<?php

use Illuminate\Support\Facades\Route;
use Modules\SisruteResumeMedis\Http\Controllers\SisruteResumeMedisController;

Route::middleware(['auth:sanctum'])->prefix('v1/sisrute-resume-medis')->group(function () {
    Route::get('resume', [SisruteResumeMedisController::class, 'index']);
    Route::post('resume', [SisruteResumeMedisController::class, 'store']);
});

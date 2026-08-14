<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatPtmRegistry\Http\Controllers\BundleController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/ptm-registry')->group(function () {
    Route::post('skrining-ptm/bundle', [BundleController::class, 'skriningPtm']);
    Route::post('kanker/bundle', [BundleController::class, 'kanker']);
    Route::post('jantung/bundle', [BundleController::class, 'jantung']);
    Route::post('stroke/bundle', [BundleController::class, 'stroke']);
    Route::post('uronefrologi/bundle', [BundleController::class, 'uronefrologi']);
});

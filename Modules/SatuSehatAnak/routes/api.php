<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatAnak\Http\Controllers\BundleController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/anak')->group(function () {
    Route::post('mtbs/bundle', [BundleController::class, 'mtbs']);
    Route::post('imunisasi/bundle', [BundleController::class, 'imunisasi']);
    Route::post('gizi/bundle', [BundleController::class, 'gizi']);
    Route::post('tumbuh-kembang/bundle', [BundleController::class, 'tumbuhKembang']);
    Route::post('pkpr/bundle', [BundleController::class, 'pkpr']);
    Route::post('imunisasi-covid19/bundle', [BundleController::class, 'imunisasiCovid19']);
});

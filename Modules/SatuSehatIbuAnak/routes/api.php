<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatIbuAnak\Http\Controllers\BundleController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/ibu-anak')->group(function () {
    Route::post('anc/bundle', [BundleController::class, 'anc']);
    Route::post('inc/bundle', [BundleController::class, 'inc']);
    Route::post('pnc/bundle', [BundleController::class, 'pnc']);
    Route::post('neonatus/bundle', [BundleController::class, 'neonatus']);
    Route::post('shk/bundle', [BundleController::class, 'shk']);
    Route::post('kematian-maternal/bundle', [BundleController::class, 'kematianMaternal']);
    Route::post('data-kelahiran/bundle', [BundleController::class, 'dataKelahiran']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\BpjsApotek\Http\Controllers\ApotekMonitoringController;
use Modules\BpjsApotek\Http\Controllers\ApotekPelayananObatController;
use Modules\BpjsApotek\Http\Controllers\ApotekPenyimpananObatController;
use Modules\BpjsApotek\Http\Controllers\ApotekPrbController;
use Modules\BpjsApotek\Http\Controllers\ApotekReferensiController;
use Modules\BpjsApotek\Http\Controllers\ApotekResepController;
use Modules\BpjsApotek\Http\Controllers\ApotekSepController;

Route::middleware(['auth:sanctum'])->prefix('v1/apotek')->group(function () {
    Route::prefix('referensi')->group(function () {
        Route::get('dpho/{query?}', [ApotekReferensiController::class, 'dpho']);
        Route::get('poli/{query?}', [ApotekReferensiController::class, 'poli']);
        Route::get('faskes/{query?}', [ApotekReferensiController::class, 'faskes']);
        Route::get('setting-apotek', [ApotekReferensiController::class, 'settingApotek']);
        Route::get('spesialistik/{query?}', [ApotekReferensiController::class, 'spesialistik']);
        Route::get('obat/{query?}', [ApotekReferensiController::class, 'obat']);
    });

    Route::apiResource('resep', ApotekResepController::class)
        ->only(['index', 'store', 'show', 'destroy'])
        ->parameters(['resep' => 'apotek_resep']);

    Route::get('pelayanan-obat', [ApotekPelayananObatController::class, 'index']);
    Route::delete('pelayanan-obat/{apotek_pelayanan_obat}', [ApotekPelayananObatController::class, 'destroy']);
    Route::get('pelayanan-obat-riwayat/{no_sep}', [ApotekPelayananObatController::class, 'history']);

    Route::post('penyimpanan-obat', [ApotekPenyimpananObatController::class, 'store']);
    Route::get('penyimpanan-obat/{apotek_penyimpanan_obat}', [ApotekPenyimpananObatController::class, 'show']);
    Route::post('penyimpanan-obat-stok', [ApotekPenyimpananObatController::class, 'updateStok']);

    Route::get('sep/{query}', [ApotekSepController::class, 'show']);
    Route::get('monitoring', [ApotekMonitoringController::class, 'index']);
    Route::get('prb', [ApotekPrbController::class, 'index']);
});

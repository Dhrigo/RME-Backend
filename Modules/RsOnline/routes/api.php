<?php

use Illuminate\Support\Facades\Route;
use Modules\RsOnline\Http\Controllers\ReferensiController;
use Modules\RsOnline\Http\Controllers\RsOnlineController;

Route::middleware(['auth:sanctum'])->prefix('v1/rs-online')->group(function () {
    Route::get('/', [RsOnlineController::class, 'index']);
    Route::get('{rsOnlineSubmission}', [RsOnlineController::class, 'show']);

    Route::post('data/sdm', [RsOnlineController::class, 'pushSdm']);
    Route::post('data/layanan', [RsOnlineController::class, 'pushLayanan']);
    Route::post('data/alkes', [RsOnlineController::class, 'pushAlkes']);
    Route::post('data/tempat-tidur', [RsOnlineController::class, 'pushTempatTidur']);

    Route::post('registrasi-user', [RsOnlineController::class, 'storeRegistrasiUser']);
    Route::put('registrasi-user/{id}', [RsOnlineController::class, 'updateRegistrasiUser']);
    Route::delete('registrasi-user/{id}', [RsOnlineController::class, 'destroyRegistrasiUser']);

    Route::get('referensi/sdm', [ReferensiController::class, 'sdm']);
    Route::get('referensi/sarana', [ReferensiController::class, 'sarana']);
    Route::get('referensi/ruang-perawatan', [ReferensiController::class, 'ruangPerawatan']);
    Route::get('referensi/pelayanan', [ReferensiController::class, 'pelayanan']);
    Route::get('referensi/kelas', [ReferensiController::class, 'kelas']);
    Route::get('referensi/kategori-sdm', [ReferensiController::class, 'kategoriSdm']);
    Route::get('referensi/kategori-layanan', [ReferensiController::class, 'kategoriLayanan']);
    Route::get('referensi/instalasi', [ReferensiController::class, 'instalasi']);
    Route::get('referensi/alkes', [ReferensiController::class, 'alkes']);
    Route::get('referensi/faskes', [ReferensiController::class, 'faskes']);
});

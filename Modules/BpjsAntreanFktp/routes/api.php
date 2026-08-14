<?php

use Illuminate\Support\Facades\Route;
use Modules\BpjsAntreanFktp\Http\Controllers\AntreanController;
use Modules\BpjsAntreanFktp\Http\Controllers\AntreanDashboardController;
use Modules\BpjsAntreanFktp\Http\Controllers\AntreanFarmasiController;
use Modules\BpjsAntreanFktp\Http\Controllers\AntreanJadwalDokterController;
use Modules\BpjsAntreanFktp\Http\Controllers\AntreanLaporanController;
use Modules\BpjsAntreanFktp\Http\Controllers\AntreanReferensiController;
use Modules\BpjsAntreanFktp\Http\Controllers\AntreanWaktuController;
use Modules\BpjsAntreanFktp\Http\Controllers\MobileJknAntreanController;
use Modules\BpjsAntreanFktp\Http\Controllers\MobileJknAntreanFarmasiController;
use Modules\BpjsAntreanFktp\Http\Controllers\MobileJknJadwalOperasiController;
use Modules\BpjsAntreanFktp\Http\Controllers\MobileJknPasienBaruController;
use Modules\BpjsAntreanFktp\Http\Controllers\MobileJknTokenController;
use Modules\BpjsAntreanFktp\Http\Middleware\VerifyBpjsMobileJknToken;

/*
|--------------------------------------------------------------------------
| Outbound (internal-facing) — this hospital -> BPJS WS BPJS antrean_fktp.
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->prefix('v1/antrean-fktp')->group(function () {
    Route::apiResource('antrean', AntreanController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['antrean' => 'antrean']);
    Route::post('antrean/{antrean}/batal', [AntreanController::class, 'batal']);

    Route::get('antrean/{antrean}/waktu', [AntreanWaktuController::class, 'index']);
    Route::post('antrean/{antrean}/waktu', [AntreanWaktuController::class, 'store']);

    Route::post('antrean/{antrean}/farmasi', [AntreanFarmasiController::class, 'store']);

    Route::prefix('referensi')->group(function () {
        Route::get('poli', [AntreanReferensiController::class, 'poli']);
        Route::get('dokter/{kodepoli}/{tanggal}', [AntreanReferensiController::class, 'dokter']);
        Route::get('jadwal-dokter/{kodedokter}/{tanggal}', [AntreanReferensiController::class, 'jadwalDokter']);
        Route::get('poli-fingerprint', [AntreanReferensiController::class, 'poliFingerPrint']);
        Route::get('pasien-fingerprint/{norm}', [AntreanReferensiController::class, 'pasienFingerPrint']);
    });

    Route::post('jadwal-dokter', [AntreanJadwalDokterController::class, 'update']);

    Route::get('dashboard/tanggal/{tanggal}/{kodepoli}', [AntreanDashboardController::class, 'perTanggal']);
    Route::get('dashboard/bulan/{bulan}/{tahun}/{kodepoli}', [AntreanDashboardController::class, 'perBulan']);

    Route::get('laporan/tanggal/{tanggal}/{kodepoli}', [AntreanLaporanController::class, 'perTanggal']);
    Route::get('laporan/kodebooking/{kodebooking}', [AntreanLaporanController::class, 'perKodeBooking']);
    Route::get('laporan/belum-dilayani/{kodepoli}', [AntreanLaporanController::class, 'belumDilayani']);
    Route::get('laporan/belum-dilayani/{kodepoli}/{kodedokter}/{tanggal}/{jampraktek}', [AntreanLaporanController::class, 'belumDilayaniDetail']);
});

/*
|--------------------------------------------------------------------------
| Inbound — BPJS Mobile JKN -> this hospital (WS RS). Own auth scheme,
| NOT auth:sanctum. Token endpoint validates x-username/x-password; every
| other inbound route is guarded by VerifyBpjsMobileJknToken (x-token/x-username).
|--------------------------------------------------------------------------
*/
Route::prefix('v1/antrean-fktp/mobile-jkn')->group(function () {
    Route::get('token', [MobileJknTokenController::class, 'index']);

    Route::middleware([VerifyBpjsMobileJknToken::class])->group(function () {
        Route::post('antrean', [MobileJknAntreanController::class, 'store']);
        Route::get('antrean/{kodebooking}', [MobileJknAntreanController::class, 'show']);
        Route::post('antrean/{kodebooking}/batal', [MobileJknAntreanController::class, 'batal']);
        Route::post('antrean/{kodebooking}/checkin', [MobileJknAntreanController::class, 'checkIn']);

        Route::post('antrean/{kodebooking}/farmasi', [MobileJknAntreanFarmasiController::class, 'store']);
        Route::get('antrean/{kodebooking}/farmasi', [MobileJknAntreanFarmasiController::class, 'show']);

        Route::post('pasien-baru', [MobileJknPasienBaruController::class, 'store']);

        Route::get('jadwal-operasi', [MobileJknJadwalOperasiController::class, 'index']);
        Route::get('jadwal-operasi/{norm}', [MobileJknJadwalOperasiController::class, 'show']);
    });
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Sisrute\Http\Controllers\ReferensiController;
use Modules\Sisrute\Http\Controllers\RujukanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('sisrute/rujukan', [RujukanController::class, 'index']);
    Route::get('sisrute/rujukan/{rujukan}', [RujukanController::class, 'show']);
    Route::post('sisrute/rujukan', [RujukanController::class, 'kirim']);
    Route::post('sisrute/rujukan/notif', [RujukanController::class, 'notif']);
    Route::post('sisrute/rujukan/jawab', [RujukanController::class, 'jawab']);
    Route::post('sisrute/rujukan/batal', [RujukanController::class, 'batal']);
    Route::post('sisrute/rujukan/images', [RujukanController::class, 'images']);
    Route::get('sisrute/rujukan-pasien/{noRujukan}', [RujukanController::class, 'pasien']);

    Route::get('sisrute/referensi/faskes', [ReferensiController::class, 'faskes']);
    Route::get('sisrute/referensi/alasan-rujukan', [ReferensiController::class, 'alasanRujukan']);
    Route::get('sisrute/referensi/diagnosa', [ReferensiController::class, 'diagnosa']);
    Route::get('sisrute/referensi/jenis-pelayanan', [ReferensiController::class, 'jenisPelayanan']);
    Route::get('sisrute/referensi/keadaan-keluar', [ReferensiController::class, 'keadaanKeluar']);
    Route::get('sisrute/referensi/cara-keluar', [ReferensiController::class, 'caraKeluar']);
    Route::get('sisrute/referensi/filter-faskes-kriteria', [ReferensiController::class, 'filterFaskesKriteria']);
    Route::get('sisrute/referensi/kriteria-khusus', [ReferensiController::class, 'kriteriaKhusus']);
    Route::get('sisrute/referensi/kriteria-rujukan', [ReferensiController::class, 'kriteriaRujukan']);
    Route::get('sisrute/referensi/kriteria-matneo', [ReferensiController::class, 'kriteriaMatneo']);
});

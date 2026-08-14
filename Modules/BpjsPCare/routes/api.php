<?php

use Illuminate\Support\Facades\Route;
use Modules\BpjsPCare\Http\Controllers\AlergiController;
use Modules\BpjsPCare\Http\Controllers\KunjunganController;
use Modules\BpjsPCare\Http\Controllers\McuController;
use Modules\BpjsPCare\Http\Controllers\PendaftaranController;
use Modules\BpjsPCare\Http\Controllers\PrognosaController;
use Modules\BpjsPCare\Http\Controllers\ReferenceController;
use Modules\BpjsPCare\Http\Controllers\SkrinningController;
use Modules\BpjsPCare\Http\Controllers\TindakanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // Pure reference/lookup passthroughs - query BPJS live, nothing persisted.
    Route::prefix('pcare-ref')->name('bpjspcare.ref.')->group(function () {
        Route::get('diagnosa', [ReferenceController::class, 'diagnosa'])->name('diagnosa');
        Route::get('dokter', [ReferenceController::class, 'dokter'])->name('dokter');
        Route::get('kelompok', [ReferenceController::class, 'kelompok'])->name('kelompok');
        Route::get('kesadaran', [ReferenceController::class, 'kesadaran'])->name('kesadaran');
        Route::get('obat', [ReferenceController::class, 'obat'])->name('obat');
        Route::get('poli', [ReferenceController::class, 'poli'])->name('poli');
        Route::get('provider', [ReferenceController::class, 'provider'])->name('provider');
        Route::get('spesialis', [ReferenceController::class, 'spesialis'])->name('spesialis');
        Route::get('status-pulang', [ReferenceController::class, 'statusPulang'])->name('status-pulang');
        Route::get('peserta', [ReferenceController::class, 'peserta'])->name('peserta');
    });

    // Kunjungan (visit/encounter) - the core PCare record.
    Route::get('kunjungans/rujukan', [KunjunganController::class, 'rujukan'])->name('bpjspcare.kunjungans.rujukan');
    Route::get('kunjungans/riwayat', [KunjunganController::class, 'riwayat'])->name('bpjspcare.kunjungans.riwayat');
    Route::apiResource('kunjungans', KunjunganController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy'])
        ->names('bpjspcare.kunjungans');

    // Pendaftaran (registration) - precedes Kunjungan, Add/Delete only per BPJS spec.
    Route::get('pendaftarans/nomor-urut', [PendaftaranController::class, 'byNomorUrut'])->name('bpjspcare.pendaftarans.nomor-urut');
    Route::get('pendaftarans/provider', [PendaftaranController::class, 'provider'])->name('bpjspcare.pendaftarans.provider');
    Route::apiResource('pendaftarans', PendaftaranController::class)
        ->only(['index', 'store', 'show', 'destroy'])
        ->names('bpjspcare.pendaftarans');

    // Encounter-scoped clinical records, FK'd to kunjungan.
    Route::apiResource('mcus', McuController::class)->names('bpjspcare.mcus');
    Route::apiResource('alergis', AlergiController::class)->names('bpjspcare.alergis');
    Route::apiResource('prognosas', PrognosaController::class)->names('bpjspcare.prognosas');
    Route::apiResource('skrinnings', SkrinningController::class)->names('bpjspcare.skrinnings');
    Route::apiResource('tindakans', TindakanController::class)->names('bpjspcare.tindakans');
});

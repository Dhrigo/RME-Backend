<?php

use Illuminate\Support\Facades\Route;
use Modules\BpjsVClaim\Http\Controllers\LpkController;
use Modules\BpjsVClaim\Http\Controllers\MonitoringController;
use Modules\BpjsVClaim\Http\Controllers\PesertaController;
use Modules\BpjsVClaim\Http\Controllers\PrbController;
use Modules\BpjsVClaim\Http\Controllers\ReferensiController;
use Modules\BpjsVClaim\Http\Controllers\RencanaKontrolController;
use Modules\BpjsVClaim\Http\Controllers\RujukanAntarRsController;
use Modules\BpjsVClaim\Http\Controllers\RujukanKhususController;
use Modules\BpjsVClaim\Http\Controllers\SepController;
use Modules\BpjsVClaim\Http\Controllers\SepPengajuanController;
use Modules\BpjsVClaim\Http\Controllers\SpriController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // SEP - all 4 creation flows share one endpoint, StoreSepRequest branches on visit_type.
    Route::get('seps', [SepController::class, 'index']);
    Route::post('seps', [SepController::class, 'store']);
    Route::get('seps/{sep}', [SepController::class, 'show']);
    Route::put('seps/{sep}', [SepController::class, 'update']);
    Route::delete('seps/{sep}', [SepController::class, 'destroy']);

    // SEP backdate/fingerprint exception submission + approval.
    Route::post('sep-pengajuans', [SepPengajuanController::class, 'store']);
    Route::post('sep-pengajuans/{sepPengajuan}/approve', [SepPengajuanController::class, 'approve']);

    // Rencana Kontrol (control-visit letter).
    Route::get('rencana-kontrols', [RencanaKontrolController::class, 'index']);
    Route::post('rencana-kontrols', [RencanaKontrolController::class, 'store']);
    Route::get('rencana-kontrols/{rencanaKontrol}', [RencanaKontrolController::class, 'show']);
    Route::put('rencana-kontrols/{rencanaKontrol}', [RencanaKontrolController::class, 'update']);
    Route::delete('rencana-kontrols/{rencanaKontrol}', [RencanaKontrolController::class, 'destroy']);
    Route::get('rencana-kontrols-lookup/spesialistik', [RencanaKontrolController::class, 'listSpesialistik']);
    Route::get('rencana-kontrols-lookup/jadwal-dokter', [RencanaKontrolController::class, 'jadwalPraktekDokter']);

    // SPRI (inpatient admission order).
    Route::get('spris', [SpriController::class, 'index']);
    Route::post('spris', [SpriController::class, 'store']);
    Route::get('spris/{spri}', [SpriController::class, 'show']);
    Route::put('spris/{spri}', [SpriController::class, 'update']);

    // Rujukan Antar RS (inter-hospital referral).
    Route::get('rujukan-antar-rs', [RujukanAntarRsController::class, 'index']);
    Route::post('rujukan-antar-rs', [RujukanAntarRsController::class, 'store']);
    Route::get('rujukan-antar-rs/{rujukanAntarRs}', [RujukanAntarRsController::class, 'show']);
    Route::put('rujukan-antar-rs/{rujukanAntarRs}', [RujukanAntarRsController::class, 'update']);
    Route::delete('rujukan-antar-rs/{rujukanAntarRs}', [RujukanAntarRsController::class, 'destroy']);

    // Rujukan Khusus (special-referral extension, e.g. hemodialysis/thalassemia).
    Route::get('rujukan-khusus', [RujukanKhususController::class, 'index']);
    Route::post('rujukan-khusus', [RujukanKhususController::class, 'store']);
    Route::get('rujukan-khusus/{rujukanKhusus}', [RujukanKhususController::class, 'show']);
    Route::delete('rujukan-khusus/{rujukanKhusus}', [RujukanKhususController::class, 'destroy']);

    // Peserta (live lookup, not persisted).
    Route::get('peserta/no-kartu/{noKartu}/tgl-sep/{tglSep}', [PesertaController::class, 'byNoKartu']);
    Route::get('peserta/nik/{nik}/tgl-sep/{tglSep}', [PesertaController::class, 'byNik']);
    Route::get('peserta/suplesi-jasa-raharja/{noKartu}/{tglPelayanan}', [PesertaController::class, 'suplesiJasaRaharja']);

    // Referensi (thin passthrough lookups, never persisted).
    Route::get('referensi/faskes/{parameter1}/{parameter2}', [ReferensiController::class, 'faskes']);
    Route::get('referensi/dokter', [ReferensiController::class, 'dokter']);
    Route::get('referensi/diagnosa/{query}', [ReferensiController::class, 'diagnosa']);
    Route::get('referensi/poli/{query}', [ReferensiController::class, 'poli']);
    Route::get('referensi/propinsi', [ReferensiController::class, 'propinsi']);
    Route::get('referensi/kabupaten/{kodePropinsi}', [ReferensiController::class, 'kabupaten']);
    Route::get('referensi/kecamatan/{kodeKabupaten}', [ReferensiController::class, 'kecamatan']);
    Route::get('referensi/procedure/{query}', [ReferensiController::class, 'procedure']);

    // PRB / LPK / Monitoring - thin read-only wrappers.
    Route::get('prb/nomor/{nomor}/no-sep/{noSep}', [PrbController::class, 'byNomor']);
    Route::get('prb/tanggal', [PrbController::class, 'byTanggal']);
    Route::get('lpk', [LpkController::class, 'list']);
    Route::get('monitoring/kunjungan', [MonitoringController::class, 'kunjungan']);
});

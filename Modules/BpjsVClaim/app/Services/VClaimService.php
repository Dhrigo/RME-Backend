<?php

namespace Modules\BpjsVClaim\Services;

use Modules\Bpjs\Services\BpjsClient;

/**
 * Thin wrapper over Modules\Bpjs\Services\BpjsClient for the VClaim v2.0 endpoint family.
 * Every call here signs/sends/decrypts through the shared kernel client (family 'vclaim') -
 * no HTTP/signature/crypto logic lives in this module. Endpoint paths ported from the
 * PDF guide "TAHAPAN PELAKSANAAN BRIDGING VCLAIM VERSI 2.0" and cross-checked against the
 * original ZF2 source (BPJService\VClaim\v_2_0\*Service.php) where available.
 */
class VClaimService
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    private function call(string $method, string $uri, array $data = []): object
    {
        return $this->client->call('vclaim', $method, $uri, $data, encrypted: true);
    }

    // ---- Peserta -----------------------------------------------------

    public function pesertaByNoKartu(string $noKartu, string $tglSep): object
    {
        return $this->call('GET', "Peserta/nokartu/{$noKartu}/tglSEP/{$tglSep}");
    }

    public function pesertaByNik(string $nik, string $tglSep): object
    {
        return $this->call('GET', "Peserta/nik/{$nik}/tglSEP/{$tglSep}");
    }

    // ---- SEP -----------------------------------------------------------

    public function insertSep(array $data): object
    {
        return $this->call('POST', 'SEP/2.0/insert', $data);
    }

    public function updateSep(array $data): object
    {
        return $this->call('PUT', 'SEP/2.0/update', $data);
    }

    public function deleteSep(array $data): object
    {
        return $this->call('DELETE', 'SEP/2.0/delete', $data);
    }

    public function cekSep(string $noSep): object
    {
        return $this->call('GET', "SEP/{$noSep}");
    }

    public function suplesiJasaRaharja(string $noKartu, string $tglPelayanan): object
    {
        return $this->call('GET', "sep/JasaRaharja/Suplesi/{$noKartu}/tglPelayanan/{$tglPelayanan}");
    }

    public function pengajuanSep(array $data): object
    {
        return $this->call('POST', 'Sep/pengajuanSEP', $data);
    }

    public function aprovalSep(array $data): object
    {
        return $this->call('POST', 'Sep/aprovalSEP', $data);
    }

    // ---- Referensi (live lookups, never persisted locally) -------------

    public function referensiFaskes(string $parameter1, string $parameter2): object
    {
        return $this->call('GET', "referensi/faskes/{$parameter1}/{$parameter2}");
    }

    public function referensiDokter(string $jenisPelayanan, string $tglPelayanan, string $kodeSpesialis): object
    {
        return $this->call('GET', "referensi/dokter/pelayanan/{$jenisPelayanan}/tglPelayanan/{$tglPelayanan}/Spesialis/{$kodeSpesialis}");
    }

    public function referensiDiagnosa(string $query): object
    {
        return $this->call('GET', "referensi/diagnosa/{$query}");
    }

    public function referensiPoli(string $query): object
    {
        return $this->call('GET', "referensi/poli/{$query}");
    }

    public function referensiPropinsi(): object
    {
        return $this->call('GET', 'referensi/propinsi');
    }

    public function referensiKabupaten(string $kodePropinsi): object
    {
        return $this->call('GET', "referensi/kabupaten/propinsi/{$kodePropinsi}");
    }

    public function referensiKecamatan(string $kodeKabupaten): object
    {
        return $this->call('GET', "referensi/kecamatan/kabupaten/{$kodeKabupaten}");
    }

    public function referensiProcedure(string $query): object
    {
        return $this->call('GET', "referensi/procedure/{$query}");
    }

    // ---- Rencana Kontrol + SPRI -----------------------------------------

    public function insertRencanaKontrol(array $data): object
    {
        return $this->call('POST', 'RencanaKontrol/insert', $data);
    }

    public function updateRencanaKontrol(array $data): object
    {
        return $this->call('PUT', 'RencanaKontrol/Update', $data);
    }

    public function deleteRencanaKontrol(array $data): object
    {
        return $this->call('DELETE', 'RencanaKontrol/Delete', $data);
    }

    public function insertSpri(array $data): object
    {
        return $this->call('POST', 'RencanaKontrol/InsertSPRI', $data);
    }

    public function updateSpri(array $data): object
    {
        return $this->call('PUT', 'RencanaKontrol/UpdateSPRI', $data);
    }

    public function listSpesialistikKontrol(string $jenisKontrol, string $nomor, string $tglRencanaKontrol): object
    {
        return $this->call('GET', "RencanaKontrol/ListSpesialistik/JnsKontrol/{$jenisKontrol}/nomor/{$nomor}/TglRencanaKontrol/{$tglRencanaKontrol}");
    }

    public function jadwalPraktekDokter(string $jenisKontrol, string $kdPoli, string $tglRencanaKontrol): object
    {
        return $this->call('GET', "RencanaKontrol/JadwalPraktekDokter/JnsKontrol/{$jenisKontrol}/KdPoli/{$kdPoli}/TglRencanaKontrol/{$tglRencanaKontrol}");
    }

    public function noSuratKontrol(string $parameter): object
    {
        return $this->call('GET', "RencanaKontrol/noSuratKontrol/{$parameter}");
    }

    public function listRencanaKontrol(string $tglAwal, string $tglAkhir, string $filter): object
    {
        return $this->call('GET', "RencanaKontrol/ListRencanaKontrol/tglAwal/{$tglAwal}/tglAkhir/{$tglAkhir}/filter/{$filter}");
    }

    // ---- Rujukan Antar RS -------------------------------------------------

    public function cariSep(string $parameter): object
    {
        return $this->call('GET', "SEP/{$parameter}");
    }

    public function insertRujukan(array $data): object
    {
        return $this->call('POST', 'Rujukan/2.0/insert', $data);
    }

    public function updateRujukan(array $data): object
    {
        return $this->call('PUT', 'Rujukan/2.0/Update', $data);
    }

    public function deleteRujukan(array $data): object
    {
        return $this->call('DELETE', 'Rujukan/delete', $data);
    }

    public function listSpesialistikRujukan(string $ppkRujukan, string $tglRujukan): object
    {
        return $this->call('GET', "Rujukan/ListSpesialistik/PPKRujukan/{$ppkRujukan}/TglRujukan/{$tglRujukan}");
    }

    public function listSaranaRujukan(string $ppkRujukan): object
    {
        return $this->call('GET', "Rujukan/ListSarana/PPKRujukan/{$ppkRujukan}");
    }

    public function listRujukanKeluar(string $tglMulai, string $tglAkhir): object
    {
        return $this->call('GET', "Rujukan/Keluar/list/TglMulai/{$tglMulai}/TglAkhir/{$tglAkhir}");
    }

    public function rujukanKeluar(string $parameter): object
    {
        return $this->call('GET', "Rujukan/Keluar/{$parameter}");
    }

    // ---- Rujukan Khusus -----------------------------------------------------

    public function rujukan(string $parameter): object
    {
        return $this->call('GET', "Rujukan/{$parameter}");
    }

    public function insertRujukanKhusus(array $data): object
    {
        return $this->call('POST', 'Rujukan/Khusus/insert', $data);
    }

    public function deleteRujukanKhusus(array $data): object
    {
        return $this->call('DELETE', 'Rujukan/Khusus/delete', $data);
    }

    public function listRujukanKhusus(string $bulan, string $tahun): object
    {
        return $this->call('GET', "Rujukan/Khusus/List/Bulan/{$bulan}/Tahun/{$tahun}");
    }

    // ---- PRB / LPK / Monitoring (thin, read-mostly) --------------------

    public function prb(string $method, array $params): object
    {
        return $this->call($method, match ($method) {
            'POST' => 'PRB/insert',
            'PUT' => 'PRB/Update',
            'DELETE' => 'PRB/Delete',
            default => 'PRB/insert',
        }, $params);
    }

    public function prbByNomor(string $nomor, string $noSep): object
    {
        return $this->call('GET', "prb/{$nomor}/nosep/{$noSep}");
    }

    public function prbByTanggal(string $tglMulai, string $tglAkhir): object
    {
        return $this->call('GET', "prb/tglMulai/{$tglMulai}/tglAkhir/{$tglAkhir}");
    }

    public function lpk(string $method, array $params): object
    {
        return $this->call($method, match ($method) {
            'POST' => 'LPK/insert',
            'PUT' => 'LPK/update',
            'DELETE' => 'LPK/delete',
            default => 'LPK/insert',
        }, $params);
    }

    public function lpkList(string $tglMasuk, string $jenisPelayanan): object
    {
        return $this->call('GET', "LPK/TglMasuk/{$tglMasuk}/JnsPelayanan/{$jenisPelayanan}");
    }

    public function monitoringKunjungan(string $tanggal, string $jenisPelayanan): object
    {
        return $this->call('GET', "Monitoring/Kunjungan/Tanggal/{$tanggal}/JnsPelayanan/{$jenisPelayanan}");
    }
}

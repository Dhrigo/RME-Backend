<?php

namespace Modules\Sitb\Services;

use Illuminate\Support\Arr;
use Modules\Sitb\Models\PasienTb;

/**
 * Push service for pasien_tb rows, ported from ZF2 SITBController::kirimAction().
 * Transform rules kept 1:1 with the source: gender 1/2->L/P, date fields
 * reformatted from Y-m-d to Ymd (no separators), zero-value classification
 * codes dropped before send.
 *
 * NOT ported: the source's setDeskripsiParamsValue() enrichment, which
 * joined ~20 `referensi` lookup tables (JENIS 92-118) to replace raw codes
 * with human descriptions before sending. No equivalent reference-lookup
 * table was found in the rebuilt SIMGOS schema for this batch's scope, so
 * raw codes are sent as-is (which is what the Entity's own fields document
 * as the payload shape) - flagged here rather than guessing a join target.
 */
class SitbService
{
    public function __construct(private readonly SitbClient $client)
    {
    }

    /**
     * Send all rows queued for send (kirim = 1), mirroring kirimAction()'s
     * bulk mode. Used by the scheduled retry command.
     */
    public function kirimSemuaAntrian(): void
    {
        PasienTb::where('kirim', 1)->oldest('updated_at')->each(fn (PasienTb $row) => $this->kirim($row));
    }

    public function kirim(PasienTb $row): PasienTb
    {
        $payload = $this->transform($row);

        try {
            $response = $this->client->send($payload);
            $status = strtolower((string) ($response->status ?? ''));

            if (in_array($status, ['berhasil', 'update berhasil', 'sukses'], true)) {
                $row->update([
                    'kirim' => 0,
                    'id_tb_03' => $response->id_tb_03 ?? $row->id_tb_03,
                    'error_message' => null,
                ]);
            } else {
                $row->update([
                    'error_message' => $response->keterangan ?? ($response->status ?? 'SITB rejected the row'),
                ]);
            }
        } catch (\Throwable $e) {
            $row->update(['error_message' => $e->getMessage()]);
        }

        return $row->fresh();
    }

    private function transform(PasienTb $row): array
    {
        // refresh() so every column is present in-memory (create() only carries
        // the attributes explicitly assigned, not DB-default nulls) before the
        // Arr::only() below picks the wire fields.
        $params = Arr::only($row->refresh()->toArray(), [
            'nourut_pasien', 'id_periode_laporan', 'tanggal_buat_laporan', 'tahun_buat_laporan',
            'kd_wasor', 'noregkab', 'kd_pasien', 'nik', 'jenis_kelamin', 'alamat_lengkap',
            'id_propinsi_faskes', 'kd_kabupaten_faskes', 'id_propinsi_pasien', 'kd_kabupaten_pasien',
            'id_kecamatan_pasien', 'id_kelurahan', 'kd_fasyankes', 'nama_rujukan', 'sebutkan1',
            'tipe_diagnosis', 'klasifikasi_lokasi_anatomi', 'klasifikasi_riwayat_pengobatan',
            'klasifikasi_status_hiv', 'total_skoring_anak', 'konfirmasiSkoring5', 'konfirmasiSkoring6',
            'tanggal_mulai_pengobatan', 'paduan_oat', 'sumber_obat', 'sebutkan',
            'sebelum_pengobatan_hasil_mikroskopis', 'sebelum_pengobatan_hasil_tes_cepat',
            'sebelum_pengobatan_hasil_biakan', 'noreglab_bulan_2', 'hasil_mikroskopis_bulan_2',
            'noreglab_bulan_3', 'hasil_mikroskopis_bulan_3', 'noreglab_bulan_5', 'hasil_mikroskopis_bulan_5',
            'akhir_pengobatan_noreglab', 'akhir_pengobatan_hasil_mikroskopis',
            'tanggal_hasil_akhir_pengobatan', 'hasil_akhir_pengobatan', 'tanggal_dianjurkan_tes',
            'tanggal_tes_hiv', 'hasil_tes_hiv', 'ppk', 'art', 'tb_dm', 'terapi_dm', 'pindah_ro', 'umur',
            'status_pengobatan', 'foto_toraks', 'toraks_tdk_dilakukan', 'keterangan', 'tahun', 'no_bpjs',
            'tgl_lahir', 'kode_icd_x', 'asal_poli',
        ]);

        // gender 1/2 -> L/P
        $params['jenis_kelamin'] = $params['jenis_kelamin'] == 1 ? 'L' : 'P';

        // dates Y-m-d -> Ymd (no separators)
        foreach (['tgl_lahir', 'tanggal_mulai_pengobatan', 'tanggal_hasil_akhir_pengobatan', 'tanggal_dianjurkan_tes', 'tanggal_tes_hiv'] as $dateField) {
            $params[$dateField] = $params[$dateField] ? str_replace('-', '', (string) $params[$dateField]) : '';
        }

        // drop zero-value classification codes (source: unset if == 0)
        foreach (['klasifikasi_lokasi_anatomi', 'klasifikasi_riwayat_pengobatan'] as $zeroableField) {
            if (($params[$zeroableField] ?? null) == 0) {
                unset($params[$zeroableField]);
            }
        }

        if (empty($params['paduan_oat'])) {
            unset($params['paduan_oat']);
        }

        foreach (['hasil_mikroskopis_bulan_2', 'hasil_mikroskopis_bulan_3', 'hasil_mikroskopis_bulan_5'] as $nullableField) {
            $params[$nullableField] = $params[$nullableField] ?? '';
        }

        return array_filter($params, fn ($value) => $value !== null);
    }
}

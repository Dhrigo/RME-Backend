<?php

namespace Modules\Sitb\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sitb\Database\Factories\PasienTbFactory;

/**
 * Staging table mirroring the ZF2 `kemkes.pasien_tb` table 1:1 (fields ported
 * from module/Kemkes/src/Kemkes/db/sitb/pasien_tb/Entity.php - not
 * summarized/renamed). `kirim` flag semantics match the source exactly:
 * 1 = queued for send (set on create/update), 0 = already sent successfully.
 */
class PasienTb extends Model
{
    use HasFactory;

    protected $table = 'pasien_tb';

    protected $fillable = [
        'nourut_pasien',
        'id_tb_03',
        'id_periode_laporan',
        'tanggal_buat_laporan',
        'tahun_buat_laporan',
        'kd_wasor',
        'noregkab',
        'kd_pasien',
        'nik',
        'jenis_kelamin',
        'alamat_lengkap',
        'id_propinsi_faskes',
        'kd_kabupaten_faskes',
        'id_propinsi_pasien',
        'kd_kabupaten_pasien',
        'id_kecamatan_pasien',
        'id_kelurahan',
        'kd_fasyankes',
        'nama_rujukan',
        'sebutkan1',
        'tipe_diagnosis',
        'klasifikasi_lokasi_anatomi',
        'klasifikasi_riwayat_pengobatan',
        'klasifikasi_status_hiv',
        'total_skoring_anak',
        'konfirmasiSkoring5',
        'konfirmasiSkoring6',
        'tanggal_mulai_pengobatan',
        'paduan_oat',
        'sumber_obat',
        'sebutkan',
        'sebelum_pengobatan_hasil_mikroskopis',
        'sebelum_pengobatan_hasil_tes_cepat',
        'sebelum_pengobatan_hasil_biakan',
        'noreglab_bulan_2',
        'hasil_mikroskopis_bulan_2',
        'noreglab_bulan_3',
        'hasil_mikroskopis_bulan_3',
        'noreglab_bulan_5',
        'hasil_mikroskopis_bulan_5',
        'akhir_pengobatan_noreglab',
        'akhir_pengobatan_hasil_mikroskopis',
        'tanggal_hasil_akhir_pengobatan',
        'hasil_akhir_pengobatan',
        'tanggal_dianjurkan_tes',
        'tanggal_tes_hiv',
        'hasil_tes_hiv',
        'ppk',
        'art',
        'tb_dm',
        'terapi_dm',
        'pindah_ro',
        'umur',
        'status_pengobatan',
        'foto_toraks',
        'toraks_tdk_dilakukan',
        'keterangan',
        'tahun',
        'no_bpjs',
        'tgl_lahir',
        'kode_icd_x',
        'asal_poli',
        'final',
        'oleh',
        'kirim',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'kirim' => 'integer',
            'final' => 'integer',
        ];
    }

    protected static function newFactory(): PasienTbFactory
    {
        return PasienTbFactory::new();
    }
}

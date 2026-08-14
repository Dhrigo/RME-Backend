<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Mirrors ZF2 `kemkes.pasien_tb` (module/Kemkes/src/Kemkes/db/sitb/pasien_tb/
     * Entity.php + Service.php) field-for-field. Types chosen conservatively
     * (string/nullable) where the source didn't imply a stricter type; date
     * fields kept as `date` since kirimAction() explodes them on "-" before
     * reformatting to Ymd for the wire payload.
     */
    public function up(): void
    {
        Schema::create('pasien_tb', function (Blueprint $table) {
            $table->id();
            $table->string('nourut_pasien')->nullable();
            $table->string('id_tb_03')->nullable(); // SITB-assigned on success
            $table->string('id_periode_laporan')->nullable();
            $table->date('tanggal_buat_laporan')->nullable();
            $table->string('tahun_buat_laporan')->nullable();
            $table->string('kd_wasor')->nullable();
            $table->string('noregkab')->nullable();
            $table->string('kd_pasien')->nullable();
            $table->string('nik')->nullable();
            $table->tinyInteger('jenis_kelamin')->nullable(); // 1=L, 2=P
            $table->text('alamat_lengkap')->nullable();
            $table->string('id_propinsi_faskes')->nullable();
            $table->string('kd_kabupaten_faskes')->nullable();
            $table->string('id_propinsi_pasien')->nullable();
            $table->string('kd_kabupaten_pasien')->nullable();
            $table->string('id_kecamatan_pasien')->nullable();
            $table->string('id_kelurahan')->nullable();
            $table->string('kd_fasyankes')->nullable();
            $table->string('nama_rujukan')->nullable();
            $table->string('sebutkan1')->nullable();
            $table->string('tipe_diagnosis')->nullable();
            $table->integer('klasifikasi_lokasi_anatomi')->nullable();
            $table->integer('klasifikasi_riwayat_pengobatan')->nullable();
            $table->integer('klasifikasi_status_hiv')->nullable();
            $table->integer('total_skoring_anak')->nullable();
            $table->integer('konfirmasiSkoring5')->nullable();
            $table->integer('konfirmasiSkoring6')->nullable();
            $table->date('tanggal_mulai_pengobatan')->nullable();
            $table->string('paduan_oat')->nullable();
            $table->integer('sumber_obat')->nullable();
            $table->string('sebutkan')->nullable();
            $table->integer('sebelum_pengobatan_hasil_mikroskopis')->nullable();
            $table->integer('sebelum_pengobatan_hasil_tes_cepat')->nullable();
            $table->integer('sebelum_pengobatan_hasil_biakan')->nullable();
            $table->string('noreglab_bulan_2')->nullable();
            $table->integer('hasil_mikroskopis_bulan_2')->nullable();
            $table->string('noreglab_bulan_3')->nullable();
            $table->integer('hasil_mikroskopis_bulan_3')->nullable();
            $table->string('noreglab_bulan_5')->nullable();
            $table->integer('hasil_mikroskopis_bulan_5')->nullable();
            $table->string('akhir_pengobatan_noreglab')->nullable();
            $table->integer('akhir_pengobatan_hasil_mikroskopis')->nullable();
            $table->date('tanggal_hasil_akhir_pengobatan')->nullable();
            $table->integer('hasil_akhir_pengobatan')->nullable();
            $table->date('tanggal_dianjurkan_tes')->nullable();
            $table->date('tanggal_tes_hiv')->nullable();
            $table->integer('hasil_tes_hiv')->nullable();
            $table->integer('ppk')->nullable();
            $table->integer('art')->nullable();
            $table->integer('tb_dm')->nullable();
            $table->integer('terapi_dm')->nullable();
            $table->integer('pindah_ro')->nullable();
            $table->integer('umur')->nullable();
            $table->integer('status_pengobatan')->nullable();
            $table->integer('foto_toraks')->nullable();
            $table->integer('toraks_tdk_dilakukan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('tahun')->nullable();
            $table->string('no_bpjs')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('kode_icd_x')->nullable();
            $table->string('asal_poli')->nullable();
            $table->tinyInteger('final')->nullable();
            $table->unsignedBigInteger('oleh')->nullable();
            $table->tinyInteger('kirim')->default(0); // 1=queued to send, 0=sent/idle
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasien_tb');
    }
};

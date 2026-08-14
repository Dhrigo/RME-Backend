<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seps', function (Blueprint $table) {
            $table->id();
            // igd = SEP IGD (non-referral emergency), rujukan_pertama = first visit via FKTP
            // referral, rujukan_lanjutan = follow-up visit via FKTP referral, rawat_inap = inpatient.
            // Each flow fills a different subset of the columns below - see PDF "TAHAPAN
            // PELAKSANAAN BRIDGING VCLAIM VERSI 2.0" section on SEP.
            $table->string('visit_type');
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->string('no_kartu');
            // referral number this SEP is issued against - required for rujukan_pertama/
            // rujukan_lanjutan/rawat_inap flows, absent for igd.
            $table->string('no_rujukan')->nullable();
            // BPJS-assigned SEP number, filled once the insert call succeeds.
            $table->string('no_sep')->nullable()->unique();
            $table->date('tgl_sep');
            $table->string('poli_tujuan')->nullable();
            // rawat_inap only - kelas rawat (1/2/3, or naik kelas VIP codes).
            $table->string('kelas_rawat')->nullable();
            $table->foreignId('dpjp_doctor_id')->nullable()->constrained('doctors')->nullOnDelete();
            $table->string('diagnosa_awal')->nullable();
            $table->text('catatan')->nullable();
            // rujukan_lanjutan only, optional - links this visit to a prior control letter.
            $table->string('no_surat_kontrol')->nullable();
            // kode Status Kecelakaan BPJS: 0 = Bukan Kecelakaan, 1 = Lalu Lintas, 2 = Kerja,
            // 3 = Umum/Lainnya (exact code list not independently verified - flagged for review).
            $table->string('status_kecelakaan')->default('0');
            $table->string('kecelakaan_provinsi_code')->nullable();
            $table->string('kecelakaan_kabupaten_code')->nullable();
            $table->string('kecelakaan_kecamatan_code')->nullable();
            $table->boolean('suplesi_jasa_raharja')->default(false);
            $table->string('local_status')->default('draft'); // draft/submitted/success/error/deleted
            $table->json('bpjs_response')->nullable();
            $table->text('error_message')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seps');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rujukan_antar_rs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients')->nullOnDelete();
            // SEP number issued by the referring hospital - this is what BPJS's
            // "GET SEP/{parameter}" search is keyed on before we build the referral.
            $table->string('no_sep_asal');
            $table->date('tanggal_rencana_kunjungan');
            $table->string('jenis_pelayanan'); // kode: 1 = R.Jalan, 2 = R.Inap
            $table->string('tipe_rujukan'); // 0 = penuh, 1 = partial, 2 = rujuk-balik
            $table->string('ppk_tujuan'); // kode faskes tujuan
            $table->string('diagnosa');
            $table->text('catatan')->nullable();
            $table->string('no_rujukan')->nullable()->unique(); // BPJS-assigned
            $table->string('local_status')->default('draft'); // draft/submitted/success/error/deleted
            $table->json('bpjs_response')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rujukan_antar_rs');
    }
};

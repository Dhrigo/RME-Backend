<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rencana_kontrols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sep_id')->constrained('seps')->cascadeOnDelete();
            // BPJS "JnsKontrol" code - exact enumeration not independently verified,
            // flagged for review (PDF references it but doesn't spell out the code list).
            $table->string('jenis_kontrol');
            // outpatient control auto-fills poli from the original referral; post-inpatient
            // control allows any poli - both cases just store the resolved kode poli here.
            $table->string('poli_kontrol');
            $table->date('tanggal_rencana_kontrol');
            $table->foreignId('dpjp_doctor_id')->nullable()->constrained('doctors')->nullOnDelete();
            $table->string('no_surat_kontrol')->nullable()->unique(); // BPJS-assigned
            $table->string('local_status')->default('draft'); // draft/submitted/success/error/deleted
            $table->json('bpjs_response')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rencana_kontrols');
    }
};

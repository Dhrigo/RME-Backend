<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SPRI = Surat Perintah Rawat Inap (inpatient admission order), submitted via
        // RencanaKontrol/InsertSPRI - shares the RencanaKontrol endpoint family with the
        // control letter but has genuinely different fields (planned admission date instead
        // of a control date, no poli), so it gets its own table rather than reusing rencana_kontrols.
        Schema::create('spris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sep_id')->constrained('seps')->cascadeOnDelete();
            $table->date('tanggal_rencana_rawat_inap');
            $table->foreignId('dpjp_doctor_id')->nullable()->constrained('doctors')->nullOnDelete();
            $table->string('no_spri')->nullable()->unique(); // BPJS-assigned
            $table->string('local_status')->default('draft'); // draft/submitted/success/error/deleted
            $table->json('bpjs_response')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spris');
    }
};

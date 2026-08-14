<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apotek_reseps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('prescription_id')->nullable()->constrained('prescriptions')->nullOnDelete();
            $table->string('no_sep');
            $table->string('no_kartu');
            // PRB (Program Rujuk Balik) resep are always rawat jalan tingkat lanjut (RJTL).
            $table->date('tanggal_resep');
            $table->date('tanggal_input');
            $table->string('poli_kode')->nullable();
            $table->json('request_payload')->nullable();
            // BPJS-issued prescription identifier, returned once the resep is saved.
            $table->string('bpjs_no_resep')->nullable();
            $table->string('status')->default('draft');
            $table->text('bpjs_message')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apotek_reseps');
    }
};

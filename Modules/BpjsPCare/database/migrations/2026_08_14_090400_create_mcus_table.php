<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mcus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->cascadeOnDelete();
            $table->date('tanggal_mcu');
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('lingkar_perut', 5, 2)->nullable();
            $table->unsignedSmallInteger('tensi_sistole')->nullable();
            $table->unsignedSmallInteger('tensi_diastole')->nullable();
            $table->decimal('gula_darah', 6, 2)->nullable();
            $table->decimal('kolesterol', 6, 2)->nullable();
            $table->decimal('asam_urat', 5, 2)->nullable();
            $table->text('hasil_mcu')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->json('bpjs_response')->nullable();
            $table->text('bpjs_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mcus');
    }
};

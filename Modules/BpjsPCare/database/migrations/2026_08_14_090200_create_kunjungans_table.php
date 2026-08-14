<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->nullable()->constrained('pendaftarans')->nullOnDelete();
            $table->string('nomor_kunjungan')->nullable();
            $table->string('no_kartu', 20);
            $table->date('tanggal_kunjungan');
            $table->string('jenis_kunjungan', 10)->default('baru');
            $table->string('kode_poli', 10);
            $table->string('kode_dokter', 10)->nullable();
            $table->string('no_rujukan', 20)->nullable();
            $table->text('keluhan')->nullable();
            $table->unsignedSmallInteger('tensi_sistole')->nullable();
            $table->unsignedSmallInteger('tensi_diastole')->nullable();
            $table->unsignedSmallInteger('nadi')->nullable();
            $table->decimal('suhu', 4, 1)->nullable();
            $table->unsignedSmallInteger('pernafasan')->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->string('kode_status_pulang', 5)->nullable();
            $table->json('bpjs_response')->nullable();
            $table->text('bpjs_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};

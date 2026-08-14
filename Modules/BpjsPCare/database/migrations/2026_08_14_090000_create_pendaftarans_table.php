<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nomor_urut');
            $table->date('tanggal_daftar');
            $table->string('no_kartu', 20);
            $table->string('nik', 20)->nullable();
            $table->string('nama_pasien');
            $table->string('poli_tujuan', 10);
            $table->string('no_hp', 20)->nullable();
            $table->text('keluhan')->nullable();
            $table->string('status', 20)->default('menunggu');
            $table->string('bpjs_no_pendaftaran')->nullable();
            $table->json('bpjs_response')->nullable();
            $table->text('bpjs_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};

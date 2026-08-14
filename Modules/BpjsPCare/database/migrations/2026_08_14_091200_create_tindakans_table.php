<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tindakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->cascadeOnDelete();
            $table->string('kode_tindakan', 10);
            $table->string('nama_tindakan');
            $table->date('tanggal_tindakan');
            $table->string('pelaksana')->nullable();
            $table->text('catatan')->nullable();
            $table->json('bpjs_response')->nullable();
            $table->text('bpjs_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tindakans');
    }
};

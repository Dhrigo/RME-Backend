<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prognosas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->cascadeOnDelete();
            $table->string('kode_diagnosa', 10);
            $table->string('nama_diagnosa');
            $table->string('hasil_prognosa', 20);
            $table->text('catatan')->nullable();
            $table->json('bpjs_response')->nullable();
            $table->text('bpjs_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prognosas');
    }
};

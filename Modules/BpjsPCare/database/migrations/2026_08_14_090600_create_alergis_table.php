<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alergis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->cascadeOnDelete();
            $table->string('jenis_alergi', 20);
            $table->string('nama_alergi');
            $table->text('reaksi')->nullable();
            $table->string('tingkat_keparahan', 10)->nullable();
            $table->json('bpjs_response')->nullable();
            $table->text('bpjs_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alergis');
    }
};

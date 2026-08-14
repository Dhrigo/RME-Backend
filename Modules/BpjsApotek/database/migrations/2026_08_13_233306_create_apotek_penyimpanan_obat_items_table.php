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
        Schema::create('apotek_penyimpanan_obat_items', function (Blueprint $table) {
            $table->id();
            // Only populated when the parent's jenis = 'racikan' - one row per
            // constituent drug ingredient in the compounded preparation.
            $table->foreignId('penyimpanan_obat_id')->constrained('apotek_penyimpanan_obats')->cascadeOnDelete();
            $table->string('kode_obat');
            $table->string('nama_obat');
            $table->decimal('jumlah', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apotek_penyimpanan_obat_items');
    }
};

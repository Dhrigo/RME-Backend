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
        Schema::create('apotek_penyimpanan_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelayanan_id')->constrained('apotek_pelayanan_obats')->cascadeOnDelete();
            // Discriminator: 'non_racikan' (single/non-compounded drug) vs 'racikan'
            // (compounded preparation, e.g. puyer/capsule mix) - racikan's constituent
            // drugs live in apotek_penyimpanan_obat_items instead of kode_obat/nama_obat here.
            $table->string('jenis');
            $table->string('kode_obat')->nullable();
            $table->string('nama_obat')->nullable();
            $table->string('nama_racikan')->nullable();
            $table->decimal('jumlah', 10, 2);
            $table->string('aturan_pakai')->nullable();
            $table->unsignedInteger('signa1')->nullable();
            $table->unsignedInteger('signa2')->nullable();
            $table->unsignedInteger('jumlah_hari')->nullable();
            $table->decimal('harga', 12, 2)->nullable();
            $table->string('bpjs_no_pelayanan_obat')->nullable();
            $table->string('status')->default('draft');
            $table->text('bpjs_message')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apotek_penyimpanan_obats');
    }
};

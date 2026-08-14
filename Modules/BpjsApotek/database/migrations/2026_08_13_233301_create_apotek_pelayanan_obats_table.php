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
        Schema::create('apotek_pelayanan_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resep_id')->constrained('apotek_reseps')->cascadeOnDelete();
            $table->string('no_sep');
            $table->date('tanggal_pelayanan');
            // BPJS-issued drug-dispensing-service identifier ("no pelayanan").
            $table->string('bpjs_no_pelayanan')->nullable();
            $table->string('status')->default('draft');
            $table->text('bpjs_message')->nullable();
            // Pelayanan obat can only be deleted before the parent claim is submitted to BPJS.
            $table->boolean('is_locked')->default(false);
            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('deleted_at_bpjs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apotek_pelayanan_obats');
    }
};

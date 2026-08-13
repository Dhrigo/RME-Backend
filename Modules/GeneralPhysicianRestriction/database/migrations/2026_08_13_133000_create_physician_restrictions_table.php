<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physician_restrictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->string('restricted_antibiotic_name');
            // Kewenangan resep: general (dokter umum), spesialis, tim_ppra (harus lewat Tim Pengendali Resistensi Antimikroba).
            $table->string('authorization_level')->default('general');
            $table->boolean('is_authorized_prescriber')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['doctor_id', 'restricted_antibiotic_name'], 'physician_restrictions_doctor_antibiotic_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physician_restrictions');
    }
};

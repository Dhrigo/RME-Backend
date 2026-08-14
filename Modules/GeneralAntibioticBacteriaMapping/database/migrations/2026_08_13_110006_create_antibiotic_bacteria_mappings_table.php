<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antibiotic_bacteria_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('antibiotic_name');
            $table->string('bacteria_name');
            // Kirby-Bauer/VITEK style susceptibility category feeding the antimicrobial
            // stewardship formulary (Layanan.FormulirAntimikroba*).
            $table->string('sensitivity_category', 1)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['antibiotic_name', 'bacteria_name'], 'abm_antibiotic_bacteria_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antibiotic_bacteria_mappings');
    }
};

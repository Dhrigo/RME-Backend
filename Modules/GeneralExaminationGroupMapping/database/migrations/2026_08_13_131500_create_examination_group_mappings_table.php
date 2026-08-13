<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examination_group_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examination_group_id')->constrained('examination_groups')->cascadeOnDelete();
            // Kategori tujuan pemetaan, mis. kategori klaim/e-klaim atau kategori pelaporan (Laboratorium, Radiologi, Elektromedik).
            $table->string('mapping_category');
            $table->string('external_code')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examination_group_mappings');
    }
};

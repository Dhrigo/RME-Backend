<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosis_restrictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_code_id')->constrained('diagnosis_codes')->cascadeOnDelete();
            $table->string('restricted_antibiotic_name');
            $table->boolean('requires_justification')->default(true);
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['diagnosis_code_id', 'restricted_antibiotic_name'], 'diagnosis_restrictions_diagnosis_antibiotic_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_restrictions');
    }
};

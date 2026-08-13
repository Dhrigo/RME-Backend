<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('diagnosis_code_id')->nullable()->constrained('diagnosis_codes')->nullOnDelete();
            $table->string('diagnosis_text')->nullable();
            $table->boolean('is_primary')->default(true);
            $table->dateTime('diagnosed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_diagnoses');
    }
};

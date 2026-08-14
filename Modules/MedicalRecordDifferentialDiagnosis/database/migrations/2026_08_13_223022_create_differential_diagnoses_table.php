<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('differential_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('diagnosis_code_id')->nullable()->constrained('diagnosis_codes')->nullOnDelete();
            $table->string('description', 255);
            $table->unsignedInteger('rank')->nullable();
            $table->foreignId('recorded_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('recorded_at');
            $table->string('status')->default('considered');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('differential_diagnoses');
    }
};

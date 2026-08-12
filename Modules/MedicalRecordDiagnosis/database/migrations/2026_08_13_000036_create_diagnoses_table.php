<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('diagnosis_code_id')->constrained('diagnosis_codes')->restrictOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->dateTime('recorded_at');
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};

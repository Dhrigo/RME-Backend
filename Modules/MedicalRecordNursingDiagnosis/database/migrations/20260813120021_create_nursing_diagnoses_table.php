<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nursing_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->string('diagnosis_label', 150);
            $table->text('related_factors')->nullable();
            $table->text('defining_characteristics')->nullable();
            $table->string('priority', 20)->nullable();
            $table->foreignId('recorded_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('recorded_at');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nursing_diagnoses');
    }
};

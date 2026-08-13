<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pharmacy_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('prescription_id')->nullable()->constrained('prescriptions')->nullOnDelete();
            $table->string('problem_category', 100);
            $table->text('description')->nullable();
            $table->text('recommendation')->nullable();
            $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('assessed_at');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pharmacy_diagnoses');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nursing_implementations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nursing_diagnosis_id')->constrained('nursing_diagnoses')->cascadeOnDelete();
            $table->text('action_taken')->nullable();
            $table->foreignId('performed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('performed_at');
            $table->text('patient_response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nursing_implementations');
    }
};

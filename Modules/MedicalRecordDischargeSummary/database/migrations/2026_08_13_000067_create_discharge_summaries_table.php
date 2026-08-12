<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discharge_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('admission_diagnosis_id')->nullable()->constrained('diagnoses')->nullOnDelete();
            $table->foreignId('discharge_diagnosis_id')->nullable()->constrained('diagnoses')->nullOnDelete();
            $table->text('treatment_summary')->nullable();
            $table->text('condition_at_discharge')->nullable();
            $table->text('follow_up_plan')->nullable();
            $table->text('discharge_medication')->nullable();
            $table->foreignId('authored_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('authored_at');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discharge_summaries');
    }
};

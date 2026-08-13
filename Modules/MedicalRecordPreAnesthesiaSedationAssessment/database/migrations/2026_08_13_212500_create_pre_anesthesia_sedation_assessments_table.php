<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_anesthesia_sedation_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->string('asa_classification', 5);
        $table->unsignedTinyInteger('mallampati_class')->nullable();
        $table->unsignedTinyInteger('npo_hours')->nullable();
        $table->text('comorbidities')->nullable();
        $table->string('planned_anesthesia_type')->nullable();
        $table->text('risk_notes')->nullable();
        $table->dateTime('assessed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_anesthesia_sedation_assessments');
    }
};

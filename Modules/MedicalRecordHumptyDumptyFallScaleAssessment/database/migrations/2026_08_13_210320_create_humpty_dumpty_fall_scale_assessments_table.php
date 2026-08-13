<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('humpty_dumpty_fall_scale_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->unsignedTinyInteger('age_score');
        $table->unsignedTinyInteger('gender_score');
        $table->unsignedTinyInteger('diagnosis_score');
        $table->unsignedTinyInteger('cognitive_impairment_score');
        $table->unsignedTinyInteger('environmental_score');
        $table->unsignedTinyInteger('surgery_sedation_score');
        $table->unsignedTinyInteger('medication_score');
        $table->unsignedTinyInteger('total_score');
        $table->string('risk_level', 20);
        $table->dateTime('assessed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('humpty_dumpty_fall_scale_assessments');
    }
};

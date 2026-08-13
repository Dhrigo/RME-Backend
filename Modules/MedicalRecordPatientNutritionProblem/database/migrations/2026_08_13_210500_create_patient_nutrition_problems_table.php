<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_nutrition_problems', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('identified_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->string('problem_category', 40);
        $table->text('problem_description');
        $table->text('intervention_plan')->nullable();
        $table->string('status', 20)->default('open');
        $table->dateTime('identified_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_nutrition_problems');
    }
};

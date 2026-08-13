<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inpatient_care_plans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('planned_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->text('care_goals');
        $table->unsignedSmallInteger('planned_length_of_stay_days')->nullable();
        $table->text('discharge_criteria')->nullable();
        $table->string('status', 20)->default('active');
        $table->dateTime('planned_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inpatient_care_plans');
    }
};

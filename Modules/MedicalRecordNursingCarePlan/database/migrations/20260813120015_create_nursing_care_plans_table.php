<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nursing_care_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->text('assessment')->nullable();
            $table->text('goal')->nullable();
            $table->text('intervention_plan')->nullable();
            $table->date('target_date')->nullable();
            $table->foreignId('recorded_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('recorded_at');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nursing_care_plans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discharge_planning_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->text('screening_criteria')->nullable();
            $table->unsignedInteger('total_score')->nullable();
            $table->boolean('requires_planning')->default(false);
            $table->foreignId('screened_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('screened_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discharge_planning_screenings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cough_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->boolean('has_cough')->default(false);
            $table->unsignedInteger('duration_weeks')->nullable();
            $table->string('cough_type', 50)->nullable();
            $table->text('other_symptoms')->nullable();
            $table->boolean('is_referred_tb_screening')->default(false);
            $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('assessed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cough_assessments');
    }
};

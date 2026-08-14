<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anamneses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->text('present_illness_history')->nullable();
            $table->text('past_medical_history')->nullable();
            $table->text('family_medical_history')->nullable();
            $table->text('allergy_history')->nullable();
            $table->text('social_history')->nullable();
            $table->foreignId('recorded_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('recorded_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anamneses');
    }
};

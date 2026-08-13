<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('morse_fall_scale_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->unsignedTinyInteger('history_of_falling');
        $table->unsignedTinyInteger('secondary_diagnosis');
        $table->unsignedTinyInteger('ambulatory_aid');
        $table->unsignedTinyInteger('iv_therapy');
        $table->unsignedTinyInteger('gait');
        $table->unsignedTinyInteger('mental_status');
        $table->unsignedSmallInteger('total_score');
        $table->string('risk_level', 20);
        $table->dateTime('assessed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('morse_fall_scale_assessments');
    }
};

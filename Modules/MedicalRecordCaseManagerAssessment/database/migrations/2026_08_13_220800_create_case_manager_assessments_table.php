<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_manager_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('case_manager_id')->nullable();
            $table->text('screening_criteria')->nullable();
            $table->string('risk_level', 10)->default('low');
            $table->text('care_plan')->nullable();
            $table->boolean('follow_up_needed')->default(false);
            $table->timestamp('assessed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_manager_assessments');
    }
};

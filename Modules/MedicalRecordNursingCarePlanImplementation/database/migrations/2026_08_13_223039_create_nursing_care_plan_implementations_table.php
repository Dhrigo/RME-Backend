<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nursing_care_plan_implementations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nursing_care_plan_id')->constrained('nursing_care_plans')->cascadeOnDelete();
            $table->text('action_taken')->nullable();
            $table->foreignId('performed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('performed_at');
            $table->text('evaluation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nursing_care_plan_implementations');
    }
};

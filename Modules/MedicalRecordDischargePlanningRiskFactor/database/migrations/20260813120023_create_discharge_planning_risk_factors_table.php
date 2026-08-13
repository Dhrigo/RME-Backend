<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discharge_planning_risk_factors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->string('risk_factor', 150);
            $table->unsignedInteger('score')->nullable();
            $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('assessed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discharge_planning_risk_factors');
    }
};

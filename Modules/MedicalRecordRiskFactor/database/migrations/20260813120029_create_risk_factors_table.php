<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('risk_factors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->string('risk_category', 100);
            $table->text('description')->nullable();
            $table->string('risk_level', 20)->nullable();
            $table->foreignId('identified_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('identified_at');
            $table->text('mitigation_plan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risk_factors');
    }
};

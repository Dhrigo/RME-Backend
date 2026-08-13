<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('requesting_department_id')->constrained('medical_departments')->cascadeOnDelete();
            $table->foreignId('consulted_department_id')->constrained('medical_departments')->cascadeOnDelete();
            $table->dateTime('requested_at');
            $table->text('question')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};

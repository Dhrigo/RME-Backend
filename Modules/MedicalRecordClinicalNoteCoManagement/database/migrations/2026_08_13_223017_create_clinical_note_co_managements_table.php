<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinical_note_co_managements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinical_note_id')->constrained('clinical_notes')->cascadeOnDelete();
            $table->foreignId('medical_department_id')->constrained('medical_departments')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->foreignId('author_id')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('recorded_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinical_note_co_managements');
    }
};

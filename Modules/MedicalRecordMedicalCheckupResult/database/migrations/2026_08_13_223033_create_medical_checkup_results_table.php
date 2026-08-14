<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_checkup_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('visit_id')->nullable()->constrained('visits')->nullOnDelete();
            $table->date('checkup_date');
            $table->string('category', 100)->nullable();
            $table->text('summary')->nullable();
            $table->text('recommendation')->nullable();
            $table->foreignId('examined_by')->constrained('employees')->cascadeOnDelete();
            $table->string('status')->default('completed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_checkup_results');
    }
};

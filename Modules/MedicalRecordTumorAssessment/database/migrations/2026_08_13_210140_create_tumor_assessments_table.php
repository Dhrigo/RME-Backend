<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tumor_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('diagnosis_id')->nullable()->constrained('diagnoses')->nullOnDelete();
        $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->string('tumor_location');
        $table->decimal('size_cm', 5, 2)->nullable();
        $table->string('tnm_t', 10)->nullable();
        $table->string('tnm_n', 10)->nullable();
        $table->string('tnm_m', 10)->nullable();
        $table->string('grade', 10)->nullable();
        $table->text('notes')->nullable();
        $table->dateTime('assessed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tumor_assessments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_family_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->string('topic', 150);
            $table->string('method', 50)->nullable();
            $table->text('barrier')->nullable();
            $table->string('understanding_level', 50)->nullable();
            $table->boolean('re_education_needed')->default(false);
            $table->foreignId('educator_id')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('educated_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_family_educations');
    }
};

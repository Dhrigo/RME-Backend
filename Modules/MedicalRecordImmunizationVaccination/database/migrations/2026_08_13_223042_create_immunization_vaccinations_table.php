<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('immunization_vaccinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('visit_id')->nullable()->constrained('visits')->nullOnDelete();
            $table->string('vaccine_name', 150);
            $table->unsignedInteger('dose_number')->nullable();
            $table->string('batch_number', 100)->nullable();
            $table->dateTime('administered_at');
            $table->foreignId('administered_by')->constrained('employees')->cascadeOnDelete();
            $table->string('site', 100)->nullable();
            $table->string('route', 50)->nullable();
            $table->text('adverse_reaction')->nullable();
            $table->string('status')->default('completed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('immunization_vaccinations');
    }
};

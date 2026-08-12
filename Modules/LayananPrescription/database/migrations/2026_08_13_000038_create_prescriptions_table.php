<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('prescription_number')->nullable()->unique();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('diagnosis_id')->nullable()->constrained('diagnoses')->nullOnDelete();
            $table->foreignId('prescribed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('prescribed_at');
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->decimal('height_cm', 5, 2)->nullable();
            // Clinical safety-check flags from SIMGOS's OrderResep - kept as the core
            // subset; renal-impairment detail, fasting status, and body-surface-area
            // (pediatric dosing) fields deferred for later.
            $table->boolean('has_drug_allergy')->default(false);
            $table->boolean('is_pregnant')->default(false);
            $table->boolean('is_breastfeeding')->default(false);
            $table->boolean('is_discharge_prescription')->default(false);
            $table->boolean('is_emergency')->default(false);
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};

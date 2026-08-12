<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->nullable()->unique();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->dateTime('registered_at');
            // Reference-lookup columns below stay plain nullable ids (no FK) until their
            // own catalog submodules (AdmissionDiagnosis, Referral, Package) are scaffolded.
            $table->unsignedBigInteger('admission_diagnosis_id')->nullable();
            $table->unsignedBigInteger('referral_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->boolean('is_emergency')->default(false);
            $table->boolean('has_fall_risk')->default(false);
            // Newborn-specific fields (SIMGOS: BERAT_BAYI/PANJANG_BAYI/JAM_LAHIR)
            $table->decimal('newborn_weight_grams', 6, 2)->nullable();
            $table->decimal('newborn_length_cm', 5, 2)->nullable();
            $table->time('birth_time')->nullable();
            // Unidentified/accident admission tracking (SIMGOS: LOKASI_DITEMUKAN/TANGGAL_DITEMUKAN)
            $table->string('found_location')->nullable();
            $table->dateTime('found_at')->nullable();
            $table->boolean('satu_sehat_consent')->default(false);
            $table->foreignId('registered_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};

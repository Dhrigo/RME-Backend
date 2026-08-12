<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('medical_record_number')->nullable()->unique();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('title_prefix')->nullable();
            $table->string('title_suffix')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained('genders')->nullOnDelete();
            $table->foreignId('religion_id')->nullable()->constrained('religions')->nullOnDelete();
            $table->string('address')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->foreignId('village_id')->nullable()->constrained('indonesia_villages')->nullOnDelete();
            // Reference-lookup columns below stay plain nullable ids (no FK) until their
            // own catalog submodules (Education, Occupation, MaritalStatus, BloodType,
            // Country, Ethnicity, Language) are scaffolded.
            $table->unsignedBigInteger('education_id')->nullable();
            $table->unsignedBigInteger('occupation_id')->nullable();
            $table->unsignedBigInteger('marital_status_id')->nullable();
            $table->unsignedBigInteger('blood_type_id')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->unsignedBigInteger('ethnicity_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->boolean('is_unidentified')->default(false);
            $table->foreignId('registered_by')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};

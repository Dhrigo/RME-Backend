<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('birth_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits');
            $table->foreignId('mother_patient_id')->constrained('patients');
            $table->string('baby_name')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained('genders');
            $table->dateTime('birth_date');
            $table->integer('birth_weight_grams')->nullable();
            $table->decimal('birth_length_cm', 4, 1)->nullable();
            $table->string('delivery_method');
            $table->foreignId('attending_doctor_id')->nullable()->constrained('employees');
            $table->text('notes')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('birth_records');
    }
};

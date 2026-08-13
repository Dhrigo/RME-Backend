<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('birth_certificate_letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_number')->unique();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('mother_patient_id')->nullable()->constrained('patients')->nullOnDelete();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->date('issue_date');
            $table->string('child_name')->nullable();
            $table->dateTime('birth_date_time')->nullable();
            $table->integer('birth_weight_grams')->nullable();
            $table->decimal('birth_length_cm', 5, 2)->nullable();
            $table->string('gender')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('birth_certificate_letters');
    }
};

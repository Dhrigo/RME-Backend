<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antimicrobial_stewardship_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits');
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('requesting_doctor_id')->nullable()->constrained('employees');
            $table->foreignId('antibiotic_restriction_id')->nullable()->constrained('antibiotic_restrictions', indexName: 'fk_asf_restr_id');
            $table->text('indication');
            $table->string('status')->default('draft');
            $table->dateTime('submitted_at')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antimicrobial_stewardship_forms');
    }
};

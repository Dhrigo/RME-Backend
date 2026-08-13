<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedure_consent_information', function (Blueprint $table) {
        $table->id();
        $table->foreignId('consent_id')->constrained('doctor_procedure_consents')->cascadeOnDelete();
        $table->foreignId('explained_by')->constrained('employees')->cascadeOnDelete();
        $table->text('diagnosis_explanation')->nullable();
        $table->text('procedure_explanation')->nullable();
        $table->text('purpose')->nullable();
        $table->text('risks_and_complications')->nullable();
        $table->text('alternative_procedures')->nullable();
        $table->text('prognosis')->nullable();
        $table->dateTime('explained_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedure_consent_information');
    }
};

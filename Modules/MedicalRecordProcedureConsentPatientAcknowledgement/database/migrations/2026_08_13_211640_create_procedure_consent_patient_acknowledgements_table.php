<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedure_consent_patient_acknowledgements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('consent_id')->constrained('doctor_procedure_consents')->cascadeOnDelete();
        $table->string('acknowledger_name');
        $table->string('relationship_to_patient', 40)->default('self');
        $table->string('decision', 10);
        $table->dateTime('signed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedure_consent_patient_acknowledgements');
    }
};

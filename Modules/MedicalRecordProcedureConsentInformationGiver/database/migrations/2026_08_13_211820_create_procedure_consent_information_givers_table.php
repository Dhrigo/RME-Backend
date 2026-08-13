<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedure_consent_information_givers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('consent_id')->constrained('doctor_procedure_consents')->cascadeOnDelete();
        $table->foreignId('giver_id')->constrained('employees')->cascadeOnDelete();
        $table->string('giver_role', 40)->default('doctor');
        $table->dateTime('signed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedure_consent_information_givers');
    }
};

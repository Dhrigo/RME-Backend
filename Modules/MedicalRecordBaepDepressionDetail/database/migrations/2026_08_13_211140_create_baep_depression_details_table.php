<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baep_depression_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('baep_protocol_id')->constrained('baep_intervention_protocols')->cascadeOnDelete();
        $table->string('scale_used', 40)->default('HDRS');
        $table->unsignedTinyInteger('score');
        $table->string('severity_level', 20)->nullable();
        $table->text('symptoms_observed')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baep_depression_details');
    }
};

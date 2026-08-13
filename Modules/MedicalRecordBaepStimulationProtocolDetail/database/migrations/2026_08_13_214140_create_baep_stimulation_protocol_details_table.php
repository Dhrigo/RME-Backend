<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baep_stimulation_protocol_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('baep_protocol_id')->constrained('baep_intervention_protocols')->cascadeOnDelete();
        $table->string('stimulation_site');
        $table->decimal('stimulation_frequency_hz', 6, 2)->nullable();
        $table->unsignedSmallInteger('stimulation_duration_minutes')->nullable();
        $table->decimal('intensity_ma', 5, 2)->nullable();
        $table->unsignedSmallInteger('number_of_sessions')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baep_stimulation_protocol_details');
    }
};

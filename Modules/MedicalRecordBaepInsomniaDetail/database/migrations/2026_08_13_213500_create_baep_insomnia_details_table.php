<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baep_insomnia_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('baep_protocol_id')->constrained('baep_intervention_protocols')->cascadeOnDelete();
        $table->string('scale_used', 40)->default('ISI');
        $table->unsignedTinyInteger('score');
        $table->unsignedSmallInteger('sleep_onset_latency_minutes')->nullable();
        $table->unsignedTinyInteger('sleep_efficiency_percent')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baep_insomnia_details');
    }
};

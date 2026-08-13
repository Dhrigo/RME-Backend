<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baep_sensory_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('baep_protocol_id')->constrained('baep_intervention_protocols')->cascadeOnDelete();
        $table->string('sensory_modality', 30);
        $table->unsignedTinyInteger('sensory_score')->nullable();
        $table->string('affected_region')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baep_sensory_details');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baep_dysphagia_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('baep_protocol_id')->constrained('baep_intervention_protocols')->cascadeOnDelete();
        $table->string('swallowing_test_used', 40)->default('GUSS');
        $table->string('severity_level', 20)->nullable();
        $table->boolean('aspiration_risk')->default(false);
        $table->string('diet_texture_recommendation')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baep_dysphagia_details');
    }
};

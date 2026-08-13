<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pressure_ulcer_risk_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedTinyInteger('sensory_perception')->default(1);
            $table->unsignedTinyInteger('moisture')->default(1);
            $table->unsignedTinyInteger('activity')->default(1);
            $table->unsignedTinyInteger('mobility')->default(1);
            $table->unsignedTinyInteger('nutrition')->default(1);
            $table->unsignedTinyInteger('friction_shear')->default(1);
            $table->unsignedTinyInteger('total_score')->default(0);
            $table->string('risk_level', 20)->nullable();
            $table->timestamp('assessed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pressure_ulcer_risk_assessments');
    }
};

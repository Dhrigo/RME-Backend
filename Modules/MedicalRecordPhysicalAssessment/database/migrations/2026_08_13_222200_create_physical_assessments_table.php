<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physical_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('mobility_status', 50)->nullable();
            $table->string('adl_status', 50)->nullable();
            $table->string('cognitive_status', 50)->nullable();
            $table->string('nutritional_risk', 20)->nullable();
            $table->unsignedTinyInteger('pain_level')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('assessed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physical_assessments');
    }
};

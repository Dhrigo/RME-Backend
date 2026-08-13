<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antimicrobial_stewardship_general_examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antimicrobial_stewardship_form_id')->constrained('antimicrobial_stewardship_forms');
            $table->decimal('temperature', 4, 1)->nullable();
            $table->integer('pulse')->nullable();
            $table->integer('respiration_rate')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->decimal('height_cm', 5, 2)->nullable();
            $table->dateTime('examined_at');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antimicrobial_stewardship_general_examinations');
    }
};

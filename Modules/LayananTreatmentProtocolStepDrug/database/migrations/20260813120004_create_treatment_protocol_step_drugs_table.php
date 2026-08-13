<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treatment_protocol_step_drugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_protocol_step_id')->constrained('treatment_protocol_steps')->cascadeOnDelete();
            $table->string('drug_name', 150);
            $table->string('dosage', 50);
            $table->string('frequency', 50);
            $table->string('route', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatment_protocol_step_drugs');
    }
};

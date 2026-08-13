<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_transfusion_observations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blood_transfusion_id');
            $table->timestamp('observed_at');
            $table->decimal('temperature_c', 4, 1)->nullable();
            $table->unsignedSmallInteger('pulse_rate')->nullable();
            $table->string('blood_pressure', 20)->nullable();
            $table->string('reaction_signs', 150)->nullable();
            $table->unsignedInteger('volume_transfused_ml')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_transfusion_observations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transcranial_doppler_windows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transcranial_doppler_examination_id')->constrained('transcranial_doppler_examinations')->cascadeOnDelete();
            $table->string('window_site', 30);
            $table->string('signal_quality', 20)->nullable();
            $table->unsignedSmallInteger('depth_mm')->nullable();
            $table->decimal('velocity_cm_s', 5, 1)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transcranial_doppler_windows');
    }
};

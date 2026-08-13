<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transcranial_doppler_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('indication', 150)->nullable();
            $table->string('vessel', 20)->nullable();
            $table->decimal('mean_velocity_cm_s', 5, 1)->nullable();
            $table->decimal('pulsatility_index', 4, 2)->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transcranial_doppler_examinations');
    }
};

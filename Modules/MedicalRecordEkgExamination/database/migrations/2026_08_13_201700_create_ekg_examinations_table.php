<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekg_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('patient_id');
            $table->integer('heart_rate_bpm')->nullable();
            $table->string('rhythm')->nullable();
            $table->string('p_wave')->nullable();
            $table->integer('pr_interval_ms')->nullable();
            $table->integer('qrs_duration_ms')->nullable();
            $table->string('st_segment')->nullable();
            $table->string('t_wave')->nullable();
            $table->text('conclusion')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekg_examinations');
    }
};

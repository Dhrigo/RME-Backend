<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nose_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('deformity')->nullable();
            $table->boolean('septum_deviation')->default(false);
            $table->boolean('turbinate_hypertrophy')->default(false);
            $table->string('nasal_discharge')->nullable();
            $table->boolean('polyp_present')->default(false);
            $table->text('notes')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nose_examinations');
    }
};

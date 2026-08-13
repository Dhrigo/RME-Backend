<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('general_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('general_appearance', 150)->nullable();
            $table->string('consciousness_level', 50)->nullable();
            $table->string('nutritional_status', 50)->nullable();
            $table->string('posture', 50)->nullable();
            $table->string('gait', 50)->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('general_examinations');
    }
};

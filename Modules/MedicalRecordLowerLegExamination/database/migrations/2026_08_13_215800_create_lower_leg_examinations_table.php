<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lower_leg_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('side', 20)->nullable();
            $table->string('muscle_strength', 10)->nullable();
            $table->boolean('edema')->default(false);
            $table->string('pulses', 50)->nullable();
            $table->string('skin_condition', 100)->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lower_leg_examinations');
    }
};

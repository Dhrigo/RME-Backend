<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eye_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('side', 20)->nullable();
            $table->string('visual_acuity', 20)->nullable();
            $table->decimal('pupil_size_mm', 4, 1)->nullable();
            $table->string('pupil_reflex', 50)->nullable();
            $table->string('conjunctiva', 100)->nullable();
            $table->string('sclera', 100)->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eye_examinations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ear_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('side', 20)->nullable();
            $table->text('otoscopy')->nullable();
            $table->string('tympanic_membrane', 100)->nullable();
            $table->string('hearing_test_result', 100)->nullable();
            $table->boolean('discharge')->default(false);
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ear_examinations');
    }
};

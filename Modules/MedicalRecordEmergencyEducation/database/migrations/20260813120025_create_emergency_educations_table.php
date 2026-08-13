<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emergency_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->string('topic', 150);
            $table->string('method', 50)->nullable();
            $table->string('understanding_level', 50)->nullable();
            $table->foreignId('educator_id')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('educated_at');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_educations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('end_of_life_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->string('topic', 150);
            $table->text('participants')->nullable();
            $table->text('decision_summary')->nullable();
            $table->foreignId('educator_id')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('educated_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('end_of_life_educations');
    }
};

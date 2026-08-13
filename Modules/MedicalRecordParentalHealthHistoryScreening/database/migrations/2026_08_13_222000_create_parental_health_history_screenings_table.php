<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parental_health_history_screenings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('screened_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->text('father_health_conditions')->nullable();
        $table->text('mother_health_conditions')->nullable();
        $table->boolean('consanguinity')->default(false);
        $table->text('genetic_disorder_history')->nullable();
        $table->dateTime('screened_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parental_health_history_screenings');
    }
};

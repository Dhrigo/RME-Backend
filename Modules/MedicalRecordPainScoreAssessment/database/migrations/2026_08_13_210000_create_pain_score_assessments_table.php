<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pain_score_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->string('scale_type', 20);
        $table->unsignedTinyInteger('score');
        $table->string('location')->nullable();
        $table->string('character')->nullable();
        $table->text('notes')->nullable();
        $table->dateTime('assessed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pain_score_assessments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->string('source', 100)->nullable();
            $table->text('recommendation')->nullable();
            $table->string('priority', 20)->nullable();
            $table->foreignId('recommended_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('recommended_at');
            $table->string('status')->default('open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_recommendations');
    }
};

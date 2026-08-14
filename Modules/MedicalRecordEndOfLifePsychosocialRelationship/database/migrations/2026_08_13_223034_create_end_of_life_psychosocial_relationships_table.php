<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('end_of_life_psychosocial_relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->string('relationship_type', 100)->nullable();
            $table->text('support_system')->nullable();
            $table->text('spiritual_needs')->nullable();
            $table->string('emotional_state', 100)->nullable();
            $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('assessed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('end_of_life_psychosocial_relationships');
    }
};

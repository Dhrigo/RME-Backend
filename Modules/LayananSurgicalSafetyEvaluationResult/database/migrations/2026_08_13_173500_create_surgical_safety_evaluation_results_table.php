<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surgical_safety_evaluation_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits');
            $table->foreignId('operating_room_id')->nullable()->constrained('operating_rooms');
            $table->foreignId('evaluator_id')->nullable()->constrained('employees');
            $table->integer('checklist_score');
            $table->boolean('compliant')->default(true);
            $table->dateTime('evaluated_at');
            $table->text('notes')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surgical_safety_evaluation_results');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fibroscan_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->date('examination_date');
            $table->decimal('liver_stiffness_kpa', 5, 2)->nullable();
            $table->decimal('cap_score', 6, 2)->nullable();
            $table->string('fibrosis_stage', 20)->nullable();
            $table->foreignId('examined_by')->constrained('employees')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fibroscan_results');
    }
};

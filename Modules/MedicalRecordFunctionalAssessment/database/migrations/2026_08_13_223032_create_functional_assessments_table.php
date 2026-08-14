<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('functional_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->date('assessment_date');
            $table->string('mobility_status', 100)->nullable();
            $table->unsignedInteger('adl_score')->nullable();
            $table->string('assistive_device', 100)->nullable();
            $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('functional_assessments');
    }
};

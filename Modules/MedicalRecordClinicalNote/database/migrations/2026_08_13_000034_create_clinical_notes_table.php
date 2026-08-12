<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinical_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->dateTime('recorded_at');
            // SOAP format (Subjective/Objective/Assessment/Planning) - standard clinical
            // note structure, matches SIMGOS's CPPT (Catatan Perkembangan Pasien
            // Terintegrasi).
            $table->text('subjective')->nullable();
            $table->text('objective')->nullable();
            $table->text('assessment')->nullable();
            $table->text('planning')->nullable();
            $table->text('instructions')->nullable();
            $table->string('note_type')->nullable();
            $table->foreignId('author_id')->constrained('employees')->cascadeOnDelete();
            $table->string('sub_division')->nullable();
            $table->boolean('has_discharge_plan')->default(false);
            $table->date('discharge_plan_date')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinical_notes');
    }
};

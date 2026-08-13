<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pathology_anatomy_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits');
            $table->foreignId('patient_id')->constrained('patients');
            $table->text('specimen_description');
            $table->text('macroscopic_finding')->nullable();
            $table->text('microscopic_finding')->nullable();
            $table->text('diagnosis')->nullable();
            $table->foreignId('examined_by')->nullable()->constrained('employees');
            $table->dateTime('examined_at');
            $table->string('status')->default('pending');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pathology_anatomy_results');
    }
};

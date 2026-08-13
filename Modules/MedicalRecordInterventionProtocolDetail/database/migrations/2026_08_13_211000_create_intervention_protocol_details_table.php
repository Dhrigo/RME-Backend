<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_protocol_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('protocol_id')->constrained('intervention_protocols')->cascadeOnDelete();
        $table->foreignId('performed_by')->constrained('employees')->cascadeOnDelete();
        $table->unsignedSmallInteger('step_number');
        $table->text('step_description');
        $table->text('result_notes')->nullable();
        $table->dateTime('performed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_protocol_details');
    }
};

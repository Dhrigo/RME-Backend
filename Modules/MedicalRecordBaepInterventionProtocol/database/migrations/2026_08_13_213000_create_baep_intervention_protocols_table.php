<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baep_intervention_protocols', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('performed_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->text('indication')->nullable();
        $table->string('stimulation_ear', 10);
        $table->decimal('click_rate_hz', 6, 2)->nullable();
        $table->unsignedSmallInteger('stimulus_intensity_db')->nullable();
        $table->decimal('wave_i_latency_ms', 5, 2)->nullable();
        $table->decimal('wave_iii_latency_ms', 5, 2)->nullable();
        $table->decimal('wave_v_latency_ms', 5, 2)->nullable();
        $table->text('interpretation')->nullable();
        $table->string('status', 20)->default('in_progress');
        $table->dateTime('performed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baep_intervention_protocols');
    }
};

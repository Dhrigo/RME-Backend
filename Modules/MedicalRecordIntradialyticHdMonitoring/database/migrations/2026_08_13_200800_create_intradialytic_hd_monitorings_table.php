<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intradialytic_hd_monitorings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('patient_id');
            $table->integer('dialysis_hour')->default(1);
            $table->integer('blood_pressure_systolic')->nullable();
            $table->integer('blood_pressure_diastolic')->nullable();
            $table->integer('blood_flow_rate')->nullable();
            $table->integer('dialysate_flow_rate')->nullable();
            $table->integer('ultrafiltration_rate')->nullable();
            $table->integer('venous_pressure')->nullable();
            $table->integer('transmembrane_pressure')->nullable();
            $table->text('symptoms')->nullable();
            $table->timestamp('monitored_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intradialytic_hd_monitorings');
    }
};

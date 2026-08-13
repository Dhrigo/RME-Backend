<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('radiology_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits');
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('ordering_doctor_id')->nullable()->constrained('employees');
            $table->dateTime('ordered_at');
            $table->text('clinical_notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radiology_orders');
    }
};

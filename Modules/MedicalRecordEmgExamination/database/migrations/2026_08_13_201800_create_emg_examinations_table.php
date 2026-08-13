<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emg_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('patient_id');
            $table->float('nerve_conduction_velocity')->nullable();
            $table->string('spontaneous_activity')->nullable();
            $table->string('motor_unit_potentials')->nullable();
            $table->string('recruitment_pattern')->nullable();
            $table->text('conclusion')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emg_examinations');
    }
};

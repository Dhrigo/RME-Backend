<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_planning_obstetrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('contraceptive_method');
            $table->date('installation_date')->nullable();
            $table->date('removal_date')->nullable();
            $table->text('side_effects')->nullable();
            $table->text('action_taken')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_planning_obstetrics');
    }
};

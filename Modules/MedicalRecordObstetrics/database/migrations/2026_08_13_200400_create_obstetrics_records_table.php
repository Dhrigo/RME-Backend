<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obstetrics_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('patient_id');
            $table->integer('gravida')->default(0);
            $table->integer('para')->default(0);
            $table->integer('abortus')->default(0);
            $table->float('gestational_age_weeks')->nullable();
            $table->float('fundal_height_cm')->nullable();
            $table->integer('fetal_heart_rate')->nullable();
            $table->string('fetal_presentation')->nullable();
            $table->integer('estimated_fetal_weight')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obstetrics_records');
    }
};

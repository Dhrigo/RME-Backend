<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grace_risk_score_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedTinyInteger('age');
            $table->unsignedSmallInteger('heart_rate');
            $table->unsignedSmallInteger('systolic_bp');
            $table->decimal('creatinine_mg_dl', 4, 2);
            $table->boolean('cardiac_arrest_at_admission')->default(false);
            $table->boolean('st_segment_deviation')->default(false);
            $table->boolean('elevated_cardiac_enzymes')->default(false);
            $table->unsignedTinyInteger('killip_class')->default(1);
            $table->unsignedSmallInteger('total_score')->default(0);
            $table->string('risk_category', 20)->nullable();
            $table->timestamp('assessed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grace_risk_score_assessments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mchat_assessment_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('patient_id');
            $table->integer('total_score')->default(0);
            $table->string('risk_level')->default('Low Risk');
            $table->json('responses_json')->nullable();
            $table->text('recommendation')->nullable();
            $table->timestamp('assessed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mchat_assessment_examinations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raven_test_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('test_form', 10)->nullable();
            $table->unsignedSmallInteger('raw_score')->nullable();
            $table->unsignedTinyInteger('percentile')->nullable();
            $table->string('iq_grade', 10)->nullable();
            $table->text('examiner_notes')->nullable();
            $table->timestamp('tested_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raven_test_examinations');
    }
};

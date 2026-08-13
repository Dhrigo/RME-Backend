<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chest_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->text('inspection')->nullable();
            $table->text('palpation')->nullable();
            $table->text('percussion')->nullable();
            $table->string('auscultation_breath_sounds')->nullable();
            $table->string('auscultation_heart_sounds')->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chest_examinations');
    }
};

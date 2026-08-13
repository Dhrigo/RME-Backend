<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anal_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->text('inspection')->nullable();
            $table->text('palpation')->nullable();
            $table->string('sphincter_tone')->nullable();
            $table->text('rectal_toucher_findings')->nullable();
            $table->string('ampulla_recti')->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anal_examinations');
    }
};

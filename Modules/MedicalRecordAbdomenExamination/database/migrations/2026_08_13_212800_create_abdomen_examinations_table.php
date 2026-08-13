<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abdomen_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->text('inspection')->nullable();
            $table->string('auscultation_bowel_sounds', 50)->nullable();
            $table->text('palpation')->nullable();
            $table->string('percussion', 50)->nullable();
            $table->boolean('tenderness')->default(false);
            $table->boolean('distension')->default(false);
            $table->decimal('liver_span_cm', 4, 1)->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abdomen_examinations');
    }
};

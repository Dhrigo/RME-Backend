<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('back_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('spine_alignment', 100)->nullable();
            $table->boolean('scoliosis')->default(false);
            $table->boolean('kyphosis')->default(false);
            $table->boolean('lordosis')->default(false);
            $table->boolean('tenderness')->default(false);
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('back_examinations');
    }
};

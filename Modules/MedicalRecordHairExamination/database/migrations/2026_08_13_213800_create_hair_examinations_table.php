<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hair_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('distribution', 100)->nullable();
            $table->string('texture', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->boolean('hair_loss')->default(false);
            $table->string('scalp_condition', 100)->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hair_examinations');
    }
};

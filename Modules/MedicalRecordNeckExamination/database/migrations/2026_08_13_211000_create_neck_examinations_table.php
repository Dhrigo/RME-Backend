<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('neck_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('lymph_nodes', 150)->nullable();
            $table->string('thyroid', 150)->nullable();
            $table->string('jugular_venous_pressure', 50)->nullable();
            $table->string('trachea_position', 50)->nullable();
            $table->boolean('mass')->default(false);
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('neck_examinations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('image_marker_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_marker_id')->constrained('image_markers')->cascadeOnDelete();
            $table->decimal('x_coordinate', 6, 2);
            $table->decimal('y_coordinate', 6, 2);
            $table->string('label', 100)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_marker_points');
    }
};

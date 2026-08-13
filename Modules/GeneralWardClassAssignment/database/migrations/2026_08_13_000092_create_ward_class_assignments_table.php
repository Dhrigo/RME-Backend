<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ward_class_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')->constrained('wards')->cascadeOnDelete();
            $table->foreignId('room_class_id')->constrained('room_classes')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['ward_id', 'room_class_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ward_class_assignments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->string('bed_number');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['room_id', 'bed_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beds');
    }
};

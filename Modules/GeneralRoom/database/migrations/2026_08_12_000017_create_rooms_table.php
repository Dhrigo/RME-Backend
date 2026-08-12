<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')->constrained('wards')->cascadeOnDelete();
            $table->string('room_number');
            // Reference-lookup column below stays a plain nullable id (no FK) until its
            // own catalog submodule (RoomClass) is scaffolded.
            $table->unsignedBigInteger('class_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['ward_id', 'room_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

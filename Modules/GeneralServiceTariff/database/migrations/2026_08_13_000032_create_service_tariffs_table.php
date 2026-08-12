<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_tariffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            // Reference-lookup column below stays a plain nullable id (no FK) until its
            // own catalog submodule (Kelas/room class) is scaffolded.
            $table->unsignedBigInteger('room_class_id')->nullable();
            $table->decimal('price', 15, 2);
            $table->date('effective_date');
            $table->string('decree_number')->nullable();
            $table->date('decree_date')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_tariffs');
    }
};

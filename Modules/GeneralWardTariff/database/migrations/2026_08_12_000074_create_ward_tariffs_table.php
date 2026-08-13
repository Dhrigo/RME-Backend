<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ward_tariffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->unsignedBigInteger('room_class_id')->nullable();
            $table->decimal('price', 15, 2);
            $table->date('effective_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ward_tariffs');
    }
};

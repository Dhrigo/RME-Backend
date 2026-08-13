<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_serial_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_item_stock_id')->constrained('ward_item_stocks')->cascadeOnDelete();
            $table->string('serial_number')->unique();
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_serial_numbers');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('minimum_stock_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->foreignId('ward_id')->nullable()->constrained('wards')->nullOnDelete();
            $table->unsignedInteger('minimum_quantity');
            $table->timestamps();

            $table->unique(['item_id', 'ward_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('minimum_stock_levels');
    }
};

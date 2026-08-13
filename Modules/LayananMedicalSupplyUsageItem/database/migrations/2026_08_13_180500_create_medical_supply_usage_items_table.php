<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_supply_usage_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_supply_usage_id')->constrained('medical_supply_usages');
            $table->foreignId('item_id')->constrained('items');
            $table->integer('quantity');
            $table->string('unit')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_supply_usage_items');
    }
};

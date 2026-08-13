<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_fulfillment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_fulfillment_id')->constrained('prescription_fulfillments')->cascadeOnDelete();
            $table->foreignId('prescription_item_id')->constrained('prescription_items')->cascadeOnDelete();
            $table->unsignedInteger('quantity_served');
            $table->boolean('is_substituted')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_fulfillment_items');
    }
};

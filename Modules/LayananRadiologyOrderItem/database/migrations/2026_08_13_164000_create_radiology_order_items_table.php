<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('radiology_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radiology_order_id')->constrained('radiology_orders');
            $table->string('examination_name');
            $table->string('body_part')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radiology_order_items');
    }
};

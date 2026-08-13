<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leftover_medication_voucher_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leftover_medication_voucher_id')->constrained('leftover_medication_vouchers');
            $table->foreignId('item_id')->constrained('items');
            $table->integer('quantity');
            $table->string('unit')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leftover_medication_voucher_items');
    }
};

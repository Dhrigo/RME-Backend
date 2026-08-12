<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('unit');
            $table->string('brand')->nullable();
            $table->boolean('is_generic')->default(false);
            $table->boolean('is_formulary')->default(false);
            $table->decimal('buy_price', 15, 2)->default(0);
            $table->decimal('sell_price', 15, 2)->default(0);
            // Simple on-hand quantity, not a full receiving/request/stock-opname ledger
            // (SIMGOS's Penerimaan/Permintaan/StokOpname submodules) - deferred, this
            // matches the source Barang entity's own embedded STOK field.
            $table->integer('stock_quantity')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

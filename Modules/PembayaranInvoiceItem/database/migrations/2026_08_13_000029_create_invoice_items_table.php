<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->string('description');
            // Which billing category this line belongs to (e.g. procedure/room/medicine),
            // kept as a plain string for now rather than replicating SIMGOS's 17 fixed
            // INACBG claim-category columns from the legacy Tagihan table - that
            // breakdown is a BPJS-claim-submission concern, not core billing.
            $table->string('category')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};

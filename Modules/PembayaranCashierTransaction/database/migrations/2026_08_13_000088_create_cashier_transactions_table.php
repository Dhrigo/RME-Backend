<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cashier_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->constrained('cashiers')->cascadeOnDelete();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('transaction_type');
            $table->dateTime('transacted_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashier_transactions');
    }
};

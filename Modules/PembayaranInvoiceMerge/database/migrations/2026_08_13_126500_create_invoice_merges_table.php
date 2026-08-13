<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_merges', function (Blueprint $table) {
            $table->id();
            // Groups multiple invoice_merges rows that were merged into the same payment.
            $table->string('merge_number')->nullable();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->decimal('allocated_amount', 15, 2);
            $table->foreignId('merged_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('merged_at');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_merges');
    }
};

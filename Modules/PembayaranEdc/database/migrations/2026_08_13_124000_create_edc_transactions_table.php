<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('edc_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->string('edc_reference_number')->unique();
            $table->string('bank_name');
            $table->string('card_type')->default('debit');
            $table->string('card_last_four', 4)->nullable();
            $table->string('approval_code')->nullable();
            $table->decimal('amount', 15, 2);
            $table->dateTime('transaction_at');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edc_transactions');
    }
};

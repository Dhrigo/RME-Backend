<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->string('transfer_reference_number')->unique();
            $table->string('source_bank_name');
            $table->string('destination_account_number');
            $table->string('destination_account_name');
            $table->decimal('amount', 15, 2);
            $table->dateTime('transferred_at');
            $table->string('proof_file_path')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_transfers');
    }
};

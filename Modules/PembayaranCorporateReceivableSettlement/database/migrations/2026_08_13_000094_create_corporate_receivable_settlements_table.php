<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('corporate_receivable_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('corporate_receivable_id')->constrained('corporate_receivables')->cascadeOnDelete();
            $table->decimal('paid_amount', 15, 2);
            $table->dateTime('paid_at');
            $table->foreignId('received_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('corporate_receivable_settlements');
    }
};

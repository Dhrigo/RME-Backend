<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_receivables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('due_date');
            $table->string('status')->default('outstanding');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_receivables');
    }
};

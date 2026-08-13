<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claim_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('claim_number')->nullable()->unique();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->foreignId('guarantor_id')->nullable()->constrained('guarantors')->nullOnDelete();
            $table->decimal('claim_amount', 15, 2);
            $table->decimal('verified_amount', 15, 2)->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->string('status')->default('draft'); // draft, submitted, verified, paid, rejected
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_invoices');
    }
};

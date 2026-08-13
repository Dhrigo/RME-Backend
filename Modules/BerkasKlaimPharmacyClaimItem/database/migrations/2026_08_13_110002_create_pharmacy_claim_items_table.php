<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pharmacy_claim_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_claim_id')->constrained('pharmacy_claims')->cascadeOnDelete();
            $table->string('drug_name');
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 15, 2);
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pharmacy_claim_items');
    }
};

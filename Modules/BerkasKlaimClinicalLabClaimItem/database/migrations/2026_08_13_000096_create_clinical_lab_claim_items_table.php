<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinical_lab_claim_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinical_lab_claim_id')->constrained('clinical_lab_claims')->cascadeOnDelete();
            $table->string('test_name');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinical_lab_claim_items');
    }
};

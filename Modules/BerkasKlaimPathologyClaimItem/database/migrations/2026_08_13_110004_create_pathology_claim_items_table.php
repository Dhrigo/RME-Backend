<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pathology_claim_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pathology_claim_id')->constrained('pathology_claims')->cascadeOnDelete();
            $table->string('exam_name');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pathology_claim_items');
    }
};

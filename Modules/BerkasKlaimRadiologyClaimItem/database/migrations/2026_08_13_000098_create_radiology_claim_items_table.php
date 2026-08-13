<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('radiology_claim_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radiology_claim_id')->constrained('radiology_claims')->cascadeOnDelete();
            $table->string('exam_name');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radiology_claim_items');
    }
};

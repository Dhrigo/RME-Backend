<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pharmacy_guarantor_margins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guarantor_id')->constrained('guarantors')->cascadeOnDelete();
            $table->decimal('margin_percentage', 5, 2);
            $table->date('effective_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pharmacy_guarantor_margins');
    }
};

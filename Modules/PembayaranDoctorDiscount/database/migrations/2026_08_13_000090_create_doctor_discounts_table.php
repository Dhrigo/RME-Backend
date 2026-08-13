<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained('discounts')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->decimal('percentage', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_discounts');
    }
};

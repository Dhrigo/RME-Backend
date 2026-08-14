<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fluid_final_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->date('period_date');
            $table->decimal('total_intake_ml', 8, 2);
            $table->decimal('total_output_ml', 8, 2);
            $table->decimal('balance_ml', 8, 2)->nullable();
            $table->foreignId('recorded_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('recorded_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fluid_final_balances');
    }
};

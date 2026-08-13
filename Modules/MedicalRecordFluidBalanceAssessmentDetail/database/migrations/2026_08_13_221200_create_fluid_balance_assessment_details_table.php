<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fluid_balance_assessment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fluid_balance_assessment_id')->constrained('fluid_balance_assessments')->cascadeOnDelete();
            $table->string('type', 10);
            $table->string('category', 50);
            $table->decimal('amount_ml', 7, 2);
            $table->timestamp('recorded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fluid_balance_assessment_details');
    }
};

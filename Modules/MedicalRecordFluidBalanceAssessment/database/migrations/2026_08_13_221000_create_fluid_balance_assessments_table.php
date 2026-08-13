<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fluid_balance_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('shift', 10)->nullable();
            $table->timestamp('assessed_at');
            $table->decimal('total_intake_ml', 8, 2)->default(0);
            $table->decimal('total_output_ml', 8, 2)->default(0);
            $table->decimal('balance_ml', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fluid_balance_assessments');
    }
};

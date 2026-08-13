<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_result_summary_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('summary_id')->constrained('lab_result_summaries')->cascadeOnDelete();
        $table->string('lab_test_name');
        $table->string('result_value', 50);
        $table->string('unit', 20)->nullable();
        $table->string('reference_range', 50)->nullable();
        $table->string('flag', 10)->default('normal');
        $table->dateTime('tested_at')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_result_summary_items');
    }
};

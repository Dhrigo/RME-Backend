<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('radiology_result_summaries', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('summarized_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->text('overall_impression')->nullable();
        $table->dateTime('summarized_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radiology_result_summaries');
    }
};

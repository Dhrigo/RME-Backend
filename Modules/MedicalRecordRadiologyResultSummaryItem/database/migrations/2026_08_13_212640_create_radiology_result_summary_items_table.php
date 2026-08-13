<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('radiology_result_summary_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('summary_id')->constrained('radiology_result_summaries')->cascadeOnDelete();
        $table->string('exam_name');
        $table->text('finding')->nullable();
        $table->text('impression')->nullable();
        $table->dateTime('performed_at')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radiology_result_summary_items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('killip_class_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->unsignedTinyInteger('killip_class');
        $table->unsignedSmallInteger('heart_rate')->nullable();
        $table->unsignedSmallInteger('respiratory_rate')->nullable();
        $table->boolean('rales_present')->default(false);
        $table->boolean('s3_gallop_present')->default(false);
        $table->text('notes')->nullable();
        $table->dateTime('assessed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('killip_class_assessments');
    }
};

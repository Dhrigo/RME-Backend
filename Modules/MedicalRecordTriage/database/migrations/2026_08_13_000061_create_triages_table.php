<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('triages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            // 1-5 acuity scale (ESI/ATS style) - 1 most urgent.
            $table->unsignedTinyInteger('level');
            $table->text('chief_complaint')->nullable();
            $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('assessed_at');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('triages');
    }
};

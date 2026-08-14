<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_initial_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained('prescriptions')->cascadeOnDelete();
            $table->foreignId('reviewed_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('reviewed_at');
            $table->boolean('is_appropriate')->default(true);
            $table->text('issues_found')->nullable();
            $table->text('recommendation')->nullable();
            $table->string('status')->default('reviewed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_initial_reviews');
    }
};

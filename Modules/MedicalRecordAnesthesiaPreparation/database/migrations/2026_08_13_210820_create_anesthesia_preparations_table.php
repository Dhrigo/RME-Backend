<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anesthesia_preparations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('prepared_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->unsignedTinyInteger('fasting_hours')->nullable();
        $table->boolean('allergy_checked')->default(false);
        $table->unsignedTinyInteger('mallampati_score')->nullable();
        $table->boolean('consent_confirmed')->default(false);
        $table->text('equipment_checklist')->nullable();
        $table->dateTime('prepared_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anesthesia_preparations');
    }
};

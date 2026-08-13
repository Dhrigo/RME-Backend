<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_and_therapies', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('ordered_by')->constrained('doctors')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->text('assessment_summary')->nullable();
        $table->text('plan_description');
        $table->string('therapy_type')->nullable();
        $table->date('target_date')->nullable();
        $table->string('status', 20)->default('active');
        $table->dateTime('ordered_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_and_therapies');
    }
};

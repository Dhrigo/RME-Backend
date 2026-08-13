<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_disease_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->boolean('previous_tb_treatment')->default(false);
        $table->unsignedSmallInteger('treatment_year')->nullable();
        $table->string('treatment_outcome')->nullable();
        $table->string('tb_category')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_disease_histories');
    }
};

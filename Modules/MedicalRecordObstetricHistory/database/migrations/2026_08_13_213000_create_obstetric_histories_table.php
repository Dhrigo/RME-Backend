<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obstetric_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->unsignedTinyInteger('pregnancy_number')->nullable();
        $table->date('delivery_date')->nullable();
        $table->string('delivery_method')->nullable();
        $table->unsignedSmallInteger('birth_weight_grams')->nullable();
        $table->text('complications')->nullable();
        $table->string('outcome')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obstetric_histories');
    }
};

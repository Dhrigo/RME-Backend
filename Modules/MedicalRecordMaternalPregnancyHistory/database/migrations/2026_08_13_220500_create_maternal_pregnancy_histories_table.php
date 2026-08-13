<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maternal_pregnancy_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->unsignedTinyInteger('gravida')->nullable();
        $table->unsignedTinyInteger('para')->nullable();
        $table->unsignedTinyInteger('abortus')->nullable();
        $table->text('pregnancy_complications')->nullable();
        $table->text('delivery_method_history')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maternal_pregnancy_histories');
    }
};

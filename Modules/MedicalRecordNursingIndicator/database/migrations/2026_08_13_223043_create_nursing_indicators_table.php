<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nursing_indicators', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->nullable()->unique();
            $table->string('name', 150);
            $table->foreignId('nursing_indicator_type_id')->nullable()->constrained('nursing_indicator_types')->nullOnDelete();
            $table->string('unit', 50)->nullable();
            $table->string('target_value', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nursing_indicators');
    }
};

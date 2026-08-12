<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_reference_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_service_parameter_id')->constrained('lab_service_parameters')->cascadeOnDelete();
            $table->enum('gender', ['male', 'female', 'all'])->default('all');
            $table->unsignedInteger('min_age')->nullable();
            $table->unsignedInteger('max_age')->nullable();
            $table->decimal('min_value', 10, 2)->nullable();
            $table->decimal('max_value', 10, 2)->nullable();
            $table->string('unit', 20)->nullable();
            $table->string('note')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_reference_values');
    }
};

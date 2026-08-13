<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_service_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_service_group_id')->nullable()->constrained('lab_service_groups')->nullOnDelete();
            $table->string('name')->unique();
            $table->string('code', 10)->nullable()->unique();
            $table->string('unit', 20)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_service_parameters');
    }
};

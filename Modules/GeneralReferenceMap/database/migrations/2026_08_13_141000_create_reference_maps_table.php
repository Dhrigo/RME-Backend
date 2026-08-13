<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reference_maps', function (Blueprint $table) {
            $table->id();
            $table->string('source_system');
            $table->string('source_code');
            $table->string('target_category');
            $table->string('target_code');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['source_system', 'source_code', 'target_category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reference_maps');
    }
};

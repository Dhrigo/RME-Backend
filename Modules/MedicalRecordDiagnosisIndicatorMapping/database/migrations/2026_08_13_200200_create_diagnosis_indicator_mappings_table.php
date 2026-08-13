<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosis_indicator_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnosis_id');
            $table->string('indicator_code');
            $table->string('indicator_name');
            $table->string('target_score')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_indicator_mappings');
    }
};

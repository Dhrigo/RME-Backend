<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('duration_restrictions', function (Blueprint $table) {
            $table->id();
            $table->string('antibiotic_name');
            $table->unsignedTinyInteger('max_days');
            $table->unsignedTinyInteger('min_days')->nullable();
            $table->boolean('requires_reevaluation')->default(true);
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('antibiotic_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('duration_restrictions');
    }
};

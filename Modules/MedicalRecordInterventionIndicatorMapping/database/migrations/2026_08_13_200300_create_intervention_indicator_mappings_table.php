<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_indicator_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('intervention_code');
            $table->string('intervention_name');
            $table->string('indicator_code');
            $table->string('indicator_name');
            $table->text('evaluation_criteria')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_indicator_mappings');
    }
};

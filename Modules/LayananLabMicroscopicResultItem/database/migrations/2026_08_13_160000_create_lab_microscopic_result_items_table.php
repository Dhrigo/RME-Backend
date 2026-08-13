<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_microscopic_result_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_microscopic_result_id')->constrained('lab_microscopic_results');
            $table->string('parameter_name');
            $table->string('value');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_microscopic_result_items');
    }
};

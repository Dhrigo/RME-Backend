<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_sensitivity_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_order_id')->constrained('lab_orders');
            $table->string('organism');
            $table->string('antibiotic_name');
            $table->string('sensitivity_result');
            $table->dateTime('examined_at');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_sensitivity_results');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_culture_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_order_id')->constrained('lab_orders');
            $table->string('specimen_type');
            $table->string('organism_found')->nullable();
            $table->string('colony_count')->nullable();
            $table->dateTime('examined_at');
            $table->string('result_status')->default('pending');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_culture_results');
    }
};

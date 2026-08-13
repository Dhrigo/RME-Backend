<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('radiology_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radiology_order_id')->constrained('radiology_orders');
            $table->text('findings');
            $table->text('impression')->nullable();
            $table->foreignId('radiologist_id')->nullable()->constrained('employees');
            $table->dateTime('examined_at');
            $table->string('status')->default('pending');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radiology_results');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_microscopic_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_order_id')->constrained('lab_orders');
            $table->string('specimen_type');
            $table->text('findings');
            $table->foreignId('examined_by')->nullable()->constrained('employees');
            $table->dateTime('examined_at');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_microscopic_results');
    }
};

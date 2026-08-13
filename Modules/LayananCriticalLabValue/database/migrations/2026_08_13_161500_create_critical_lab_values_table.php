<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('critical_lab_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_order_id')->constrained('lab_orders');
            $table->string('parameter_name');
            $table->string('critical_value');
            $table->string('notified_to')->nullable();
            $table->dateTime('notified_at')->nullable();
            $table->boolean('acknowledged')->default(false);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('critical_lab_values');
    }
};

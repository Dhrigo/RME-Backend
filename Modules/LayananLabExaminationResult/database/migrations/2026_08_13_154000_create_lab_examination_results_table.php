<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_examination_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_order_id')->constrained('lab_orders');
            $table->string('parameter_name');
            $table->string('result_value');
            $table->string('unit')->nullable();
            $table->string('reference_range')->nullable();
            $table->boolean('is_abnormal')->default(false);
            $table->dateTime('examined_at');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_examination_results');
    }
};

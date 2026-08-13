<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rehabilitation_procedure_examination_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rehabilitation_procedure_examination_id')->constrained('rehabilitation_procedure_examinations')->cascadeOnDelete();
            $table->string('step_name', 150);
            $table->unsignedSmallInteger('duration_minutes')->nullable();
            $table->string('result', 100)->nullable();
            $table->unsignedSmallInteger('sequence')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rehabilitation_procedure_examination_items');
    }
};

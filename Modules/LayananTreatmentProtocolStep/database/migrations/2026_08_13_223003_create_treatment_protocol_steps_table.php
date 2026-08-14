<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treatment_protocol_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_protocol_id')->constrained('treatment_protocols')->cascadeOnDelete();
            $table->unsignedInteger('sequence');
            $table->string('instruction', 255);
            $table->dateTime('scheduled_at')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatment_protocol_steps');
    }
};

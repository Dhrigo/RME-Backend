<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surgery_performers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surgery_id')->nullable();
            $table->unsignedBigInteger('visit_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('role')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surgery_performers');
    }
};

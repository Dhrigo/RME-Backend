<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('file_path');
            $table->dateTime('taken_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_photos');
    }
};

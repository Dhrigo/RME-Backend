<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_department_ward_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_department_id')->constrained('medical_departments')->cascadeOnDelete();
            $table->foreignId('ward_id')->constrained('wards')->cascadeOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->date('assigned_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_department_ward_assignments');
    }
};

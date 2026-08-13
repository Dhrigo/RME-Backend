<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_personnel', function (Blueprint $table) {
            $table->id();
            $table->string('identity_number')->nullable()->unique();
            $table->string('name');
            $table->string('personnel_type');
            $table->foreignId('profession_id')->nullable()->constrained('professions')->nullOnDelete();
            $table->string('license_number')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_personnel');
    }
};

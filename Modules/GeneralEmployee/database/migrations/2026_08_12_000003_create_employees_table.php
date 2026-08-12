<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('employee_number')->nullable()->unique();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('title_prefix')->nullable();
            $table->string('title_suffix')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            // Reference-lookup columns below stay plain nullable ids (no FK) until their
            // own catalog submodules (Religion, Gender, Profession, Smf) are scaffolded.
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->unsignedBigInteger('smf_id')->nullable();
            $table->string('address')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('region_code')->nullable();
            $table->boolean('is_non_employee')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

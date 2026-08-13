<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_supply_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits');
            $table->foreignId('recorded_by')->nullable()->constrained('users');
            $table->dateTime('used_at');
            $table->string('status')->default('draft');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_supply_usages');
    }
};

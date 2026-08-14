<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pharmacy_service_time_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_service_time_id')->constrained('pharmacy_service_times')->cascadeOnDelete();
            $table->string('stage_name', 50);
            $table->dateTime('recorded_at');
            $table->foreignId('recorded_by')->nullable()->constrained('employees')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pharmacy_service_time_stages');
    }
};

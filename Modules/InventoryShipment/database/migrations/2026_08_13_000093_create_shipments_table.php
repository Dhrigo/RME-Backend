<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_ward_id')->constrained('wards')->cascadeOnDelete();
            $table->foreignId('to_ward_id')->constrained('wards')->cascadeOnDelete();
            $table->foreignId('shipped_by')->constrained('employees')->cascadeOnDelete();
            $table->dateTime('shipped_at');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

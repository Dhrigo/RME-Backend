<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ward_transfer_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_ward_id')->constrained('wards');
            $table->foreignId('to_ward_id')->constrained('wards');
            $table->boolean('requires_approval')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['from_ward_id', 'to_ward_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ward_transfer_routes');
    }
};

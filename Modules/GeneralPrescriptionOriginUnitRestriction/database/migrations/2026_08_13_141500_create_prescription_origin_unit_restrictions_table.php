<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_origin_unit_restrictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')->constrained('wards');
            $table->foreignId('item_id')->nullable()->constrained('items');
            $table->boolean('is_allowed')->default(true);
            $table->text('note')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_origin_unit_restrictions');
    }
};

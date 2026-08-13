<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quantity_restrictions', function (Blueprint $table) {
            $table->id();
            $table->string('drug_name');
            $table->unsignedInteger('max_quantity_per_prescription');
            // Satuan kemasan/dosis, mis. tablet, vial, ampul, botol.
            $table->string('unit');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('drug_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quantity_restrictions');
    }
};

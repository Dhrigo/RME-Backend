<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antibiotic_restrictions', function (Blueprint $table) {
            $table->id();
            $table->string('antibiotic_name');
            // Klasifikasi WHO AWaRe untuk pengendalian resistensi antimikroba: access, watch, reserve.
            $table->string('aware_category');
            $table->boolean('requires_pra_approval')->default(false);
            $table->text('restriction_condition')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('antibiotic_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antibiotic_restrictions');
    }
};

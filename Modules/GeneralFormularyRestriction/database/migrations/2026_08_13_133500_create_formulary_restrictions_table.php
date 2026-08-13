<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formulary_restrictions', function (Blueprint $table) {
            $table->id();
            $table->string('drug_name');
            // Kategori formularium: fornas (Formularium Nasional), formularium_rs, non_formularium.
            $table->string('formulary_category');
            $table->boolean('requires_substitution')->default(false);
            $table->string('substitution_drug_name')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('drug_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formulary_restrictions');
    }
};

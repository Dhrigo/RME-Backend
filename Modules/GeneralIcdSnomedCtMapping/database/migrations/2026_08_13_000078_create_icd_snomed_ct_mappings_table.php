<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('icd_snomed_ct_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('icd_code', 20);
            $table->string('snomed_code', 20);
            $table->string('icd_description')->nullable();
            $table->string('snomed_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['icd_code', 'snomed_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('icd_snomed_ct_mappings');
    }
};

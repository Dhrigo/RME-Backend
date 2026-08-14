<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_frequency_rule_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_frequency_rule_id')->constrained('prescription_frequency_rules', indexName: 'fk_pfrc_rule_id')->cascadeOnDelete();
            // Pengelompokan cara pemberian, mis. "Oral", "Injeksi", "Rutin", "Jika Perlu (PRN)".
            $table->string('category_name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_frequency_rule_categories');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_frequency_rules', function (Blueprint $table) {
            $table->id();
            // Kode aturan pakai resep, mis. "1x1", "3x1", "2x1 pc" (dipakai di lembar resep/etiket obat).
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->unsignedTinyInteger('times_per_day');
            $table->unsignedTinyInteger('interval_hours')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_frequency_rules');
    }
};

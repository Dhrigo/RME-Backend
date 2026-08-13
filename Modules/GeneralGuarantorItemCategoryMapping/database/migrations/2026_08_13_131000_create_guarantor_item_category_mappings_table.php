<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guarantor_item_category_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guarantor_id')->constrained('guarantors')->cascadeOnDelete();
            $table->foreignId('item_category_id')->constrained('item_categories')->cascadeOnDelete();
            $table->boolean('is_covered')->default(true);
            // Persentase yang ditanggung penjamin untuk golongan barang farmasi ini (mis. 100 untuk full cover).
            $table->decimal('coverage_percentage', 5, 2)->default(100);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['guarantor_id', 'item_category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guarantor_item_category_mappings');
    }
};

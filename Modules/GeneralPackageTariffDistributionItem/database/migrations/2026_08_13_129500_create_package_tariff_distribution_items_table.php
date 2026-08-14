<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_tariff_distribution_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_tariff_distribution_id')->constrained('package_tariff_distributions', indexName: 'fk_ptdi_dist_id')->cascadeOnDelete();
            $table->string('recipient_type'); // dokter, perawat, rumah_sakit, farmasi
            // recipient_id points at whichever table recipient_type designates (doctors, nurses, ...).
            // Left as a loose-end FK: no single target table applies across all recipient types.
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->decimal('amount', 15, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_tariff_distribution_items');
    }
};

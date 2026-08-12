<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_tariff_distributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_tariff_id')->nullable();
            $table->unsignedBigInteger('component_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_tariff_distributions');
    }
};

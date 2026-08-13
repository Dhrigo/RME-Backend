<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_provider_id')->constrained('payment_providers')->cascadeOnDelete();
            $table->string('service_code')->nullable()->unique();
            $table->string('service_name');
            $table->string('service_type')->default('va_transfer'); // va_transfer, qris, credit_card, e_wallet
            $table->string('admin_fee_type')->default('flat'); // flat, percentage
            $table->decimal('admin_fee_amount', 15, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_services');
    }
};

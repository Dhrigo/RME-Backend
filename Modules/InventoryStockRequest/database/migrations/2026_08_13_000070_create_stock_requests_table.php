<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();
            $table->foreignId('ward_id')->constrained('wards')->cascadeOnDelete();
            // One item per request - multi-line requests (PermintaanDetil) deferred,
            // same scope reduction pattern as GoodsReceipt.
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->foreignId('requested_by')->constrained('users')->cascadeOnDelete();
            $table->dateTime('requested_at');
            $table->dateTime('fulfilled_at')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_requests');
    }
};

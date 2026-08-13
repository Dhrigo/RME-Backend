<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transfer_medication_reconciliation_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('reconciliation_id')->constrained('transfer_medication_reconciliations')->cascadeOnDelete();
        $table->string('drug_name');
        $table->string('dose', 50)->nullable();
        $table->string('frequency', 50)->nullable();
        $table->string('route', 30)->nullable();
        $table->string('action', 20);
        $table->string('reason')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfer_medication_reconciliation_items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_medication_reconciliation_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('reconciliation_id')->constrained('admission_medication_reconciliations', indexName: 'fk_amri_reconciliation_id')->cascadeOnDelete();
        $table->string('drug_name');
        $table->string('dose', 50)->nullable();
        $table->string('frequency', 50)->nullable();
        $table->string('route', 30)->nullable();
        $table->string('action', 20);
        $table->string('reason')->nullable();
        $table->dateTime('last_taken_at')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_medication_reconciliation_items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained('prescriptions')->cascadeOnDelete();
            // Drug identified by name only for now - not yet linked to a pharmacy/
            // inventory item master (Inventory module's item catalog is a separate,
            // larger scope not built yet).
            $table->string('drug_name');
            $table->string('dosage');
            $table->string('frequency');
            $table->string('route')->nullable();
            $table->string('duration')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};

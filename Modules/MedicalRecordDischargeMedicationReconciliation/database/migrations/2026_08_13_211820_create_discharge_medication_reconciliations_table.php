<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discharge_medication_reconciliations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('reconciled_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->string('source_of_medication_list')->nullable();
        $table->text('notes')->nullable();
        $table->string('status', 20)->default('draft');
        $table->dateTime('reconciled_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discharge_medication_reconciliations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_protocols', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('started_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->string('protocol_name');
        $table->text('indication')->nullable();
        $table->string('status', 20)->default('active');
        $table->dateTime('started_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_protocols');
    }
};

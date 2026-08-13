<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_handovers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('ward_id')->constrained('wards')->cascadeOnDelete();
            $table->foreignId('handed_over_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('received_by')->nullable()->constrained('employees')->nullOnDelete();
            $table->dateTime('handed_over_at');
            $table->dateTime('received_at')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_handovers');
    }
};

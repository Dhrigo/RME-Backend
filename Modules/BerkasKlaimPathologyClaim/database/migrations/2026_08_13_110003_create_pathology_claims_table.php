<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pathology_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_file_id')->constrained('claim_files')->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained('lab_orders')->nullOnDelete();
            $table->dateTime('submitted_at')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pathology_claims');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claim_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->string('claim_number')->unique();
            $table->dateTime('submitted_at')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
            
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_files');
    }
};

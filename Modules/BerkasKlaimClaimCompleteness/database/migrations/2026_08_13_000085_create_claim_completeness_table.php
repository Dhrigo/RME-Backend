<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claim_completeness', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_file_id');
            $table->string('checklist_item');
            $table->boolean('is_complete')->default(false);
            $table->string('checked_by')->nullable();
            $table->dateTime('checked_at')->nullable();
            $table->timestamps();
            
            $table->foreign('claim_file_id')->references('id')->on('claim_files')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_completeness');
    }
};

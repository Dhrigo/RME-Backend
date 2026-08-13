<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supporting_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_file_id');
            $table->string('document_type');
            $table->string('file_path');
            $table->dateTime('uploaded_at')->nullable();
            $table->timestamps();
            
            $table->foreign('claim_file_id')->references('id')->on('claim_files')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supporting_documents');
    }
};

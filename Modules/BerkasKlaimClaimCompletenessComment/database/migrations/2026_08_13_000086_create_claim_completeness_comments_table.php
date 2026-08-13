<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claim_completeness_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_completeness_id');
            $table->text('comment');
            $table->string('commented_by')->nullable();
            $table->dateTime('commented_at')->nullable();
            $table->timestamps();
            
            $table->foreign('claim_completeness_id', 'ccc_completeness_id_foreign')->references('id')->on('claim_completeness')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_completeness_comments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_result_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_result_id')->constrained('lab_results');
            $table->text('note');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_result_notes');
    }
};

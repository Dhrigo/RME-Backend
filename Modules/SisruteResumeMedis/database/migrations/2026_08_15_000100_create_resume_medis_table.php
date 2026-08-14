<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resume_medis', function (Blueprint $table) {
            $table->id();
            $table->json('payload');
            $table->json('response')->nullable();
            $table->string('status')->default('pending'); // pending/sent/failed
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resume_medis');
    }
};

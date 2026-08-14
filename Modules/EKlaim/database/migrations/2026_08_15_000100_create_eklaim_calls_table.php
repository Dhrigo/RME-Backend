<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eklaim_calls', function (Blueprint $table) {
            $table->id();
            $table->string('method'); // ws.php metadata.method value
            $table->json('request_data')->nullable();
            $table->json('response_data')->nullable();
            $table->string('status')->default('pending'); // pending/sent/failed
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eklaim_calls');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rs_online_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('resource'); // data_sdm/data_layanan/alkes_data/data_tempat_tidur/registrasi_user
            $table->json('payload');
            $table->json('response')->nullable();
            $table->string('status')->default('pending'); // pending/sent/failed
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rs_online_submissions');
    }
};

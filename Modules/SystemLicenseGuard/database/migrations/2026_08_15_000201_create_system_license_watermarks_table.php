<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_license_watermarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('highest_seen_timestamp')->index(); // Unix timestamp
            $table->dateTime('recorded_at');
            $table->string('checksum', 64); // HMAC of timestamp to prevent DB edit
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_license_watermarks');
    }
};

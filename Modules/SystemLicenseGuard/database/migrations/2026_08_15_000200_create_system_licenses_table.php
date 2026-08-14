<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('instance_id', 64)->unique();
            $table->string('client_name');
            $table->string('client_code', 50)->index();
            $table->string('license_key', 128)->unique();
            $table->longText('token_payload'); // Full base64 or JSON payload signed by central server
            $table->longText('digital_signature'); // RSA signature
            $table->string('hardware_id', 128)->index();
            $table->string('tier', 50)->default('standard'); // starter, standard, pro, enterprise
            $table->dateTime('issued_at');
            $table->dateTime('valid_until')->index();
            $table->dateTime('last_synced_at')->nullable();
            $table->unsignedInteger('max_users')->default(0); // 0 = unlimited
            $table->json('allowed_modules'); // JSON array of allowed module names
            $table->string('integrity_hash', 64); // HMAC-SHA256 for local tamper detection
            $table->string('status', 30)->default('active'); // active, expired, suspended, tampered
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_licenses');
    }
};

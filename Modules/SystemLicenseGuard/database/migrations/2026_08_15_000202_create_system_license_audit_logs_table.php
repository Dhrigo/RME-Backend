<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_license_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type', 50)->index(); // activated, verified, heartbeat_sent, clock_tamper_detected, fingerprint_mismatch, module_denied
            $table->json('details')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_license_audit_logs');
    }
};

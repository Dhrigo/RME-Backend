<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tokens issued to BPJS's Mobile JKN app after it authenticates against
     * the Token endpoint with x-username/x-password (WS RS inbound auth
     * scheme). Every subsequent inbound call carries x-token/x-username,
     * validated by VerifyBpjsMobileJknToken middleware against this table.
     */
    public function up(): void
    {
        Schema::create('antrean_fktp_mobile_jkn_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('token')->unique();
            $table->dateTime('expires_at');
            $table->timestamps();

            $table->index(['username', 'token']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrean_fktp_mobile_jkn_tokens');
    }
};

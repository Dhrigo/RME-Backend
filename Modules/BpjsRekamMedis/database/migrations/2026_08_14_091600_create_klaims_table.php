<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Local tracking record for the SmartClaim/RekamMedis "kirim" flow - one row per
     * (no_sep, jenis_pelayanan_id, bulan, tahun), ported from BPJS\SmartClaim\db\klaim\v3\
     * Entity.php in the original ZF2 source (BPJS\SmartClaim\V1\Rpc\Klaim\KlaimController::
     * kirimAction()).
     */
    public function up(): void
    {
        Schema::create('klaims', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_sep');
            $table->string('jenis_pelayanan_id');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('dibuat_oleh')->nullable();
            $table->dateTime('dibuat_tanggal')->nullable();
            $table->string('dikirim_oleh')->nullable();
            $table->dateTime('dikirim_tanggal')->nullable();
            // draft/sent/error - local outcome of the rekammedis/insert submission.
            $table->string('status')->default('draft');
            $table->json('bpjs_response')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->unique(['no_sep', 'jenis_pelayanan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('klaims');
    }
};

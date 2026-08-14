<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sirs_online_bor_tempat_tidurs', function (Blueprint $table) {
            $table->id();
            // Exact field names from the live-verified payload (part3.md Task 1) -
            // not renamed/summarized.
            $table->string('id_tt');
            $table->string('ruang');
            $table->integer('jumlah_ruang')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('terpakai')->nullable();
            $table->integer('terpakai_suspek')->nullable();
            $table->integer('terpakai_konfirmasi')->nullable();
            $table->integer('antrian')->nullable();
            $table->integer('prepare')->nullable();
            $table->integer('prepare_plan')->nullable();
            $table->integer('covid')->nullable();
            $table->integer('terpakai_dbd')->nullable();
            $table->integer('terpakai_dbd_anak')->nullable();
            $table->integer('jumlah_dbd')->nullable();
            $table->json('response')->nullable();
            $table->string('status')->default('pending'); // pending/sent/failed/deleted
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sirs_online_bor_tempat_tidurs');
    }
};

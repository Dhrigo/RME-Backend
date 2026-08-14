<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Submission/approval trail for the SEP backdate & fingerprint exception flow
        // (POST Sep/pengajuanSEP then POST Sep/aprovalSEP). Only fingerprint approvals
        // happen at hospital level - backdate approvals happen at BPJS's own office, so
        // this table just records what we submitted and whatever status BPJS reports back.
        Schema::create('sep_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sep_id')->constrained('seps')->cascadeOnDelete();
            $table->string('jenis'); // backdate | fingerprint
            $table->text('alasan');
            $table->string('status')->default('submitted'); // submitted/approved/rejected
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('approved_at')->nullable();
            $table->json('bpjs_response')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sep_pengajuans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Local queue booking record, mirroring BPJS's "Tambah Antrean" payload
     * (WS BPJS antrean/add) plus local sync-state fields. Populated either
     * from an outbound trigger (this hospital books a queue) or an inbound
     * "Ambil Antrean" call from Mobile JKN (patient books remotely).
     */
    public function up(): void
    {
        Schema::create('antrean_rs_antreans', function (Blueprint $table) {
            $table->id();
            $table->string('kodebooking')->unique();
            $table->foreignId('visit_id')->nullable()->constrained('visits')->nullOnDelete();
            $table->string('jenispasien');
            $table->string('nomorkartu')->nullable();
            $table->string('nik')->nullable();
            $table->string('nohp')->nullable();
            $table->string('kodepoli');
            $table->string('namapoli')->nullable();
            $table->boolean('pasienbaru')->default(false);
            $table->string('norm')->nullable();
            $table->date('tanggalperiksa');
            $table->unsignedBigInteger('kodedokter');
            $table->string('namadokter')->nullable();
            $table->string('jampraktek')->nullable();
            // 1=Rujukan FKTP, 2=Rujukan Internal, 3=Kontrol, 4=Rujukan Antar RS
            $table->unsignedTinyInteger('jeniskunjungan');
            $table->string('nomorreferensi')->nullable();
            $table->string('nomorantrean')->nullable();
            $table->unsignedInteger('angkaantrean')->nullable();
            $table->dateTime('estimasidilayani')->nullable();
            $table->unsignedInteger('sisakuotajkn')->nullable();
            $table->unsignedInteger('kuotajkn')->nullable();
            $table->unsignedInteger('sisakuotanonjkn')->nullable();
            $table->unsignedInteger('kuotanonjkn')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status')->default('draft');
            $table->json('request_payload')->nullable();
            $table->string('bpjs_sync_status')->default('pending');
            $table->text('bpjs_error')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrean_rs_antreans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Task-timeline child table for "Update Waktu Antrean" (antrean/updatewaktu).
     * Each row logs one state transition (taskid 1-7, or 99 = tidak hadir/batal).
     */
    public function up(): void
    {
        Schema::create('antrean_rs_antrean_waktus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antrean_id')->constrained('antrean_rs_antreans')->cascadeOnDelete();
            $table->unsignedTinyInteger('task_id');
            $table->dateTime('waktu');
            $table->string('jenis_resep')->nullable();
            $table->string('bpjs_sync_status')->default('pending');
            $table->text('bpjs_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrean_rs_antrean_waktus');
    }
};

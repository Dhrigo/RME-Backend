<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rujukans', function (Blueprint $table) {
            $table->id();
            $table->string('direction'); // outbound/inbound
            $table->string('action'); // rujukan/notifrujukan/jawabrujukan/batalrujukan/imagesrujukan
            $table->string('no_rujukan')->nullable(); // SISRUTE-assigned
            $table->json('payload');
            $table->json('response')->nullable();
            $table->string('status')->default('pending'); // pending/sent/failed
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rujukans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aplicares_room_syncs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->unique()->constrained('rooms')->cascadeOnDelete();
            // BPJS-assigned room identifier, returned by the "Ruangan Baru" endpoint.
            $table->string('bpjs_room_id')->nullable();
            $table->unsignedInteger('bed_count')->default(0);
            $table->unsignedInteger('available_count')->default(0);
            $table->string('sync_status')->default('pending');
            $table->text('sync_message')->nullable();
            $table->dateTime('last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplicares_room_syncs');
    }
};

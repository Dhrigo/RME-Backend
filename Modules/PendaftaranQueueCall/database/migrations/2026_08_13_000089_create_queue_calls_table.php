<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('queue_calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_queue_id')->constrained('ward_queues')->cascadeOnDelete();
            $table->dateTime('called_at');
            $table->foreignId('called_by')->constrained('users')->cascadeOnDelete();
            // Loket/counter number the queue number is called to.
            $table->string('counter');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('queue_calls');
    }
};

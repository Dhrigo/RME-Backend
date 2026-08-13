<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kaps', function (Blueprint $table) {
            $table->id();
            // Loose-end FK: no Pasien (patient) module exists yet in this app.
            $table->string('patient_norm');
            $table->string('card_type');
            $table->string('card_number');
            $table->timestamps();

            $table->unique(['patient_norm', 'card_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaps');
    }
};

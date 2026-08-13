<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_guardian_identity_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_guardian_id')->constrained('patient_guardians')->cascadeOnDelete();
            $table->string('card_type');
            $table->string('card_number');
            $table->date('issued_date')->nullable();
            $table->string('address')->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('region_code', 10)->nullable();
            $table->timestamps();

            $table->unique(['patient_guardian_id', 'card_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_guardian_identity_cards');
    }
};

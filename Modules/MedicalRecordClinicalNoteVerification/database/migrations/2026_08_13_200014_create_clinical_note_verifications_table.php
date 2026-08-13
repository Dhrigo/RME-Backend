<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinical_note_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinical_note_id')->constrained('clinical_notes')->cascadeOnDelete();
            $table->foreignId('verifier_doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->string('verification_status')->default('Verified');
            $table->dateTime('verified_at');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinical_note_verifications');
    }
};

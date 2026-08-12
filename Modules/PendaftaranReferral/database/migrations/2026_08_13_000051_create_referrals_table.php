<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->string('referral_number')->unique();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            // incoming = patient referred to this hospital from elsewhere,
            // outgoing = this hospital refers patient to another facility.
            $table->string('direction');
            $table->string('facility_name');
            $table->text('reason')->nullable();
            $table->dateTime('referred_at');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};

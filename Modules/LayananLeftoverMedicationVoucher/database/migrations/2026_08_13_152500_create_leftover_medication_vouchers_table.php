<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leftover_medication_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_number');
            $table->foreignId('visit_id')->constrained('visits');
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('prescription_id')->nullable()->constrained('prescriptions');
            $table->string('status')->default('pending');
            $table->dateTime('issued_at');
            $table->dateTime('redeemed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique('voucher_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leftover_medication_vouchers');
    }
};

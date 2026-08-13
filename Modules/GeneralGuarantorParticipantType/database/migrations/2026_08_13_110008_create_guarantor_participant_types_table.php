<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guarantor_participant_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code', 20)->nullable()->unique();
            // Scopes which Guarantor::PAYER_TYPES this participant type applies under
            // (self_pay/bpjs/insurance/corporate) - e.g. "PBI APBN" only makes sense
            // under payer_type=bpjs.
            $table->string('payer_type');
            $table->boolean('requires_verification')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guarantor_participant_types');
    }
};

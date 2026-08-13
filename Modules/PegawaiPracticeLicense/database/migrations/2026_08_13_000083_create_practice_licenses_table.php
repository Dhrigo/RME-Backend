<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practice_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            // STR = Surat Tanda Registrasi, SIP = Surat Izin Praktik.
            $table->string('license_type');
            $table->string('license_number')->unique();
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->string('issuing_authority')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practice_licenses');
    }
};

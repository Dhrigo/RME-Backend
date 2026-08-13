<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_escort_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_escort_id')->constrained('patient_escorts')->cascadeOnDelete();
            $table->string('contact_type')->default('mobile');
            $table->string('contact_value');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_escort_contacts');
    }
};

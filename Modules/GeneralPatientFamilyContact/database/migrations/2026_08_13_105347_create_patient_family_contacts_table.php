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
        Schema::create('patient_family_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_family_id')->index(); // Loose-end FK
            $table->string('contact_type'); // e.g. Phone, Email
            $table->string('contact_value');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_family_contacts');
    }
};

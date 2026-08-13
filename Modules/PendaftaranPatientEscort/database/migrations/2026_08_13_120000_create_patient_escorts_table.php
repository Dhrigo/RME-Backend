<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_escorts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations')->cascadeOnDelete();
            $table->string('full_name');
            $table->string('relationship_to_patient')->default('other');
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('arrival_mode')->default('private_vehicle');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_escorts');
    }
};

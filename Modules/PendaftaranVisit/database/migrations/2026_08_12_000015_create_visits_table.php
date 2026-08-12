<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visit_number')->nullable()->unique();
            $table->foreignId('registration_id')->constrained('registrations')->cascadeOnDelete();
            $table->foreignId('attending_physician_id')->nullable()->constrained('employees')->nullOnDelete();
            // Room/bed stay plain nullable ids (no FK) until their own catalog submodules
            // (Ruangan/RuangKamarTidur) are scaffolded.
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('bed_id')->nullable();
            $table->dateTime('admitted_at');
            $table->dateTime('discharged_at')->nullable();
            $table->boolean('is_new_visit')->default(true);
            $table->boolean('is_deposit')->default(false);
            $table->unsignedBigInteger('deposit_class_id')->nullable();
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('final_outcome')->nullable();
            $table->foreignId('final_outcome_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('final_outcome_at')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};

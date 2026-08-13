<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_transfusion_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transfusion_id')->constrained('blood_transfusions')->cascadeOnDelete();
            $table->string('blood_bag_number');
            $table->string('blood_type')->nullable();
            $table->integer('volume_ml');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->text('reaction_observed')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_transfusion_details');
    }
};

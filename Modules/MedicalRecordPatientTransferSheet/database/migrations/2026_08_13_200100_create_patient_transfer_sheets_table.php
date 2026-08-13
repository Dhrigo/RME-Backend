<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_transfer_sheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('from_ward_id')->nullable();
            $table->unsignedBigInteger('to_ward_id')->nullable();
            $table->text('transfer_reason')->nullable();
            $table->text('patient_condition')->nullable();
            $table->timestamp('transferred_at')->nullable();
            $table->unsignedBigInteger('transferred_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_transfer_sheets');
    }
};

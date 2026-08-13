<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembatalan_visit_cancellations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits');
            $table->foreignId('cancelled_by')->constrained('users');
            $table->text('reason');
            $table->dateTime('cancelled_at');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembatalan_visit_cancellations');
    }
};

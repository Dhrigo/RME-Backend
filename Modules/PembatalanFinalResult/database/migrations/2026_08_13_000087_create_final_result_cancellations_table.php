<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('final_result_cancellations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('cancellation_number')->unique();
            $table->text('reason');
            $table->dateTime('cancellation_date');
            $table->string('requested_by');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('final_result_cancellations');
    }
};

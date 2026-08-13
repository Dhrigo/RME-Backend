<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('document_cancellations', function (Blueprint $table) {
            $table->id();
            $table->string('document_id');
            $table->string('document_type');
            $table->string('cancellation_number')->unique();
            $table->text('reason');
            $table->dateTime('cancellation_date');
            $table->string('requested_by');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('document_cancellations');
    }
};

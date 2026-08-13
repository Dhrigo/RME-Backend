<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blood_transfusion_id')->constrained('blood_transfusions')->cascadeOnDelete();
            $table->string('blood_component', 50);
            $table->string('blood_type', 10)->nullable();
            $table->unsignedInteger('bag_quantity');
            $table->string('cross_match_result', 50)->nullable();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_request_items');
    }
};

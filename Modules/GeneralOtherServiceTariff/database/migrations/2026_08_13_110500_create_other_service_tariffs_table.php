<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('other_service_tariffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('other_service_id')->constrained('other_services')->cascadeOnDelete();
            $table->foreignId('room_class_id')->nullable()->constrained('room_classes')->nullOnDelete();
            $table->decimal('price', 15, 2);
            $table->date('effective_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_service_tariffs');
    }
};

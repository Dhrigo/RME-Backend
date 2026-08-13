<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guarantor_subspecialties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guarantor_id')->constrained('guarantors')->cascadeOnDelete();
            $table->string('subspecialty_name');
            $table->boolean('is_covered')->default(true);
            $table->text('coverage_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guarantor_subspecialties');
    }
};

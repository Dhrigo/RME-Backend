<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skin_prick_test_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('allergen', 150);
            $table->decimal('wheal_size_mm', 4, 1)->nullable();
            $table->decimal('flare_size_mm', 4, 1)->nullable();
            $table->string('result', 20)->default('equivocal');
            $table->unsignedSmallInteger('reaction_onset_minutes')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('tested_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skin_prick_test_examinations');
    }
};

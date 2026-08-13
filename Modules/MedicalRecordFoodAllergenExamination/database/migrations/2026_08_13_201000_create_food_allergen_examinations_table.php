<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_allergen_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('food_item');
            $table->string('reaction_grade')->nullable();
            $table->float('wheal_diameter_mm')->nullable();
            $table->text('symptoms_observed')->nullable();
            $table->text('interpretation')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_allergen_examinations');
    }
};

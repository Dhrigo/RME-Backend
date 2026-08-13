<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antimicrobial_stewardship_form_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antimicrobial_stewardship_form_id')->constrained('antimicrobial_stewardship_forms');
            $table->foreignId('item_id')->nullable()->constrained('items');
            $table->string('dose');
            $table->string('route');
            $table->string('frequency');
            $table->integer('planned_duration_days')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antimicrobial_stewardship_form_items');
    }
};

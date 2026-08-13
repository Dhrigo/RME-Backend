<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antimicrobial_stewardship_prior_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antimicrobial_stewardship_form_id')->constrained('antimicrobial_stewardship_forms');
            $table->string('previous_antibiotic');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('outcome')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antimicrobial_stewardship_prior_histories');
    }
};

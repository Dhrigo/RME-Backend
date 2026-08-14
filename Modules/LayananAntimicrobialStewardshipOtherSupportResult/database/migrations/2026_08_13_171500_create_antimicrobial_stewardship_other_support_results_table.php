<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antimicrobial_stewardship_other_support_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antimicrobial_stewardship_form_id')->constrained('antimicrobial_stewardship_forms', indexName: 'fk_asosr_form_id');
            $table->string('examination_name');
            $table->text('result_value');
            $table->dateTime('examined_at');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antimicrobial_stewardship_other_support_results');
    }
};

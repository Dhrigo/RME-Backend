<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pathology_immunofluorescence_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pathology_anatomy_result_id')->constrained('pathology_anatomy_results', indexName: 'fk_pir_anatomy_id');
            $table->string('marker');
            $table->string('result');
            $table->string('intensity')->nullable();
            $table->dateTime('examined_at');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pathology_immunofluorescence_results');
    }
};

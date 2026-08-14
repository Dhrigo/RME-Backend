<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anamnesis_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anamnesis_id')->constrained('anamneses')->cascadeOnDelete();
            $table->string('source_type', 50);
            $table->string('source_name', 150)->nullable();
            $table->string('relationship', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anamnesis_sources');
    }
};

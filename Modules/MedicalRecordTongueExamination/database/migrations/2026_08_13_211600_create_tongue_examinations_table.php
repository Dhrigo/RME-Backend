<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tongue_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('color', 50)->nullable();
            $table->string('coating', 100)->nullable();
            $table->string('moisture', 50)->nullable();
            $table->string('lesions', 150)->nullable();
            $table->string('movement', 100)->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tongue_examinations');
    }
};

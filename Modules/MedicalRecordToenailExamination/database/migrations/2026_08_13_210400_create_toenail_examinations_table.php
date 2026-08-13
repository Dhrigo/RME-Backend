<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('toenail_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('color', 50)->nullable();
            $table->unsignedTinyInteger('capillary_refill_seconds')->nullable();
            $table->boolean('clubbing')->default(false);
            $table->boolean('cyanosis')->default(false);
            $table->string('lesions', 150)->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toenail_examinations');
    }
};

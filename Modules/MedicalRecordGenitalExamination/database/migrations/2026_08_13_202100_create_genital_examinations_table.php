<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('genital_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->text('external_genitalia')->nullable();
            $table->string('discharge_characteristics')->nullable();
            $table->text('lesions_or_masses')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genital_examinations');
    }
};

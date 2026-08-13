<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            // Loose-end FK: GeneralPpk doesn't exist yet when this migration was written.
            $table->unsignedBigInteger('ppk_id')->nullable()->unique();
            $table->string('email');
            $table->string('website');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};

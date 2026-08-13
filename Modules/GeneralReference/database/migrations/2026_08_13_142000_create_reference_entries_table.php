<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reference_entries', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['category', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reference_entries');
    }
};

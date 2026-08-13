<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('implementation_checklist_items', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->nullable()->unique();
            $table->string('name', 150);
            $table->string('category', 100)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('implementation_checklist_items');
    }
};

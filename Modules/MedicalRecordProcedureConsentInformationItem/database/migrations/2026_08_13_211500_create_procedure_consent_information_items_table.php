<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedure_consent_information_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('information_id')->constrained('procedure_consent_information')->cascadeOnDelete();
        $table->string('item_name');
        $table->boolean('is_explained')->default(false);
        $table->boolean('is_understood')->default(false);
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedure_consent_information_items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Reference-lookup columns below stay plain nullable ids (no FK) until their
            // own catalog submodules (WardType, VisitType) are scaffolded.
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('visit_type_id')->nullable();
            $table->boolean('allows_request')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};

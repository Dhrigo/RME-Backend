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
            // type_id stays a plain nullable id (no FK) until WardType is scaffolded -
            // no standalone catalog submodule for it exists yet in the source.
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

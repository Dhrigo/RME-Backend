<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physical_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('general_condition')->nullable();
            $table->string('consciousness_gcs')->nullable();
            $table->text('head_to_toe_notes')->nullable();
            $table->unsignedBigInteger('examined_by')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physical_examinations');
    }
};

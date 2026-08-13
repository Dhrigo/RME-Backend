<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leg_joint_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('joint', 30)->nullable();
            $table->string('range_of_motion', 100)->nullable();
            $table->boolean('swelling')->default(false);
            $table->boolean('tenderness')->default(false);
            $table->string('deformity', 100)->nullable();
            $table->text('findings')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leg_joint_examinations');
    }
};

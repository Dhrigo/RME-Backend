<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pharynx_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('mucosa_color')->nullable();
            $table->boolean('exudate')->default(false);
            $table->boolean('post_nasal_drip')->default(false);
            $table->string('posterior_wall_condition')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pharynx_examinations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dental_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->integer('decayed_teeth_count')->default(0);
            $table->integer('missing_teeth_count')->default(0);
            $table->integer('filled_teeth_count')->default(0);
            $table->json('odontogram_json')->nullable();
            $table->string('occlusion_status')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dental_examinations');
    }
};

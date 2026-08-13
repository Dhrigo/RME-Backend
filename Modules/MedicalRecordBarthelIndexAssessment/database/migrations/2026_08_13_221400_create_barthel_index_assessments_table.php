<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barthel_index_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->unsignedTinyInteger('feeding')->default(0);
            $table->unsignedTinyInteger('bathing')->default(0);
            $table->unsignedTinyInteger('grooming')->default(0);
            $table->unsignedTinyInteger('dressing')->default(0);
            $table->unsignedTinyInteger('bowel_control')->default(0);
            $table->unsignedTinyInteger('bladder_control')->default(0);
            $table->unsignedTinyInteger('toilet_use')->default(0);
            $table->unsignedTinyInteger('transfers')->default(0);
            $table->unsignedTinyInteger('mobility')->default(0);
            $table->unsignedTinyInteger('stairs')->default(0);
            $table->unsignedTinyInteger('total_score')->default(0);
            $table->string('interpretation', 30)->nullable();
            $table->timestamp('assessed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barthel_index_assessments');
    }
};

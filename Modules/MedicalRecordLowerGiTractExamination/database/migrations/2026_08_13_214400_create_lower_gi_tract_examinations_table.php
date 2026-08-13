<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lower_gi_tract_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('procedure_type', 50)->default('colonoscopy');
            $table->text('colon_findings')->nullable();
            $table->text('rectum_findings')->nullable();
            $table->boolean('polyps_found')->default(false);
            $table->boolean('biopsy_taken')->default(false);
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lower_gi_tract_examinations');
    }
};

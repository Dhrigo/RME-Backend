<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upper_gi_tract_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->string('procedure_type', 50)->default('endoscopy');
            $table->text('esophagus_findings')->nullable();
            $table->text('stomach_findings')->nullable();
            $table->text('duodenum_findings')->nullable();
            $table->string('hpylori_result', 20)->nullable();
            $table->timestamp('examined_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upper_gi_tract_examinations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('functional_status_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
        $table->foreignId('assessed_by')->constrained('employees')->cascadeOnDelete();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->string('bathing_status', 20)->default('independent');
        $table->string('dressing_status', 20)->default('independent');
        $table->string('toileting_status', 20)->default('independent');
        $table->string('transferring_status', 20)->default('independent');
        $table->string('feeding_status', 20)->default('independent');
        $table->unsignedTinyInteger('total_score')->nullable();
        $table->dateTime('assessed_at');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('functional_status_assessments');
    }
};

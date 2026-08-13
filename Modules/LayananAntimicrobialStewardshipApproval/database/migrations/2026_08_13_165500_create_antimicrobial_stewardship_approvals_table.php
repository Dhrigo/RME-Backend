<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antimicrobial_stewardship_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antimicrobial_stewardship_form_id')->constrained('antimicrobial_stewardship_forms');
            $table->foreignId('approved_by')->nullable()->constrained('employees');
            $table->string('decision');
            $table->text('decision_note')->nullable();
            $table->dateTime('decided_at');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antimicrobial_stewardship_approvals');
    }
};

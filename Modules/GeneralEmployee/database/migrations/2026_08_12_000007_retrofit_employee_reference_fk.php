<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('religion_id')->references('id')->on('religions')->nullOnDelete();
            $table->foreign('gender_id')->references('id')->on('genders')->nullOnDelete();
            $table->foreign('profession_id')->references('id')->on('professions')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['religion_id']);
            $table->dropForeign(['gender_id']);
            $table->dropForeign(['profession_id']);
        });
    }
};

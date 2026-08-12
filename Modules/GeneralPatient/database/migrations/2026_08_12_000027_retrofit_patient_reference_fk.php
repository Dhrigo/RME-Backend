<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->foreign('education_id')->references('id')->on('educations')->nullOnDelete();
            $table->foreign('occupation_id')->references('id')->on('occupations')->nullOnDelete();
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses')->nullOnDelete();
            $table->foreign('blood_type_id')->references('id')->on('blood_types')->nullOnDelete();
            $table->foreign('nationality_id')->references('id')->on('countries')->nullOnDelete();
            $table->foreign('ethnicity_id')->references('id')->on('ethnicities')->nullOnDelete();
            $table->foreign('language_id')->references('id')->on('languages')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['education_id']);
            $table->dropForeign(['occupation_id']);
            $table->dropForeign(['marital_status_id']);
            $table->dropForeign(['blood_type_id']);
            $table->dropForeign(['nationality_id']);
            $table->dropForeign(['ethnicity_id']);
            $table->dropForeign(['language_id']);
        });
    }
};

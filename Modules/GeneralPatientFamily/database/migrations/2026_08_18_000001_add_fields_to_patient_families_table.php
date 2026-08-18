<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient_families', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('relationship');
            $table->foreignId('gender_id')->nullable()->after('birth_date')->constrained('genders')->nullOnDelete();
            // Reference-lookup columns below stay plain nullable ids (no FK), matching
            // the pattern already used on the patients table.
            $table->unsignedBigInteger('education_id')->nullable()->after('gender_id');
            $table->unsignedBigInteger('occupation_id')->nullable()->after('education_id');
            $table->string('address')->nullable()->after('occupation_id');
            $table->string('rt', 5)->nullable()->after('address');
            $table->string('rw', 5)->nullable()->after('rt');
            $table->string('postal_code', 10)->nullable()->after('rw');
            $table->foreignId('village_id')->nullable()->after('postal_code')->constrained('indonesia_villages')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('patient_families', function (Blueprint $table) {
            $table->dropConstrainedForeignId('village_id');
            $table->dropConstrainedForeignId('gender_id');
            $table->dropColumn(['birth_date', 'education_id', 'occupation_id', 'address', 'rt', 'rw', 'postal_code']);
        });
    }
};

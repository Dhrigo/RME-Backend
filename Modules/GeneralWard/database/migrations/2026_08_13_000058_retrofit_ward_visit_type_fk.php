<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wards', function (Blueprint $table) {
            $table->foreign('visit_type_id')->references('id')->on('ward_visit_types')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('wards', function (Blueprint $table) {
            $table->dropForeign(['visit_type_id']);
        });
    }
};

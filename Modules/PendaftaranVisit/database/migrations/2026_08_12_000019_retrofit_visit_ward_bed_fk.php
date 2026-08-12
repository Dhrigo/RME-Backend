<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->renameColumn('room_id', 'ward_id');
        });

        Schema::table('visits', function (Blueprint $table) {
            $table->foreign('ward_id')->references('id')->on('wards')->nullOnDelete();
            $table->foreign('bed_id')->references('id')->on('beds')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropForeign(['ward_id']);
            $table->dropForeign(['bed_id']);
        });

        Schema::table('visits', function (Blueprint $table) {
            $table->renameColumn('ward_id', 'room_id');
        });
    }
};

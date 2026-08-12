<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_tariffs', function (Blueprint $table) {
            $table->foreign('room_class_id')->references('id')->on('room_classes')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('service_tariffs', function (Blueprint $table) {
            $table->dropForeign(['room_class_id']);
        });
    }
};

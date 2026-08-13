<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppks', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->nullable()->unique();
            $table->string('bpjs_code', 8)->nullable();
            $table->unsignedTinyInteger('type')->nullable();
            $table->unsignedTinyInteger('ownership')->nullable();
            $table->unsignedTinyInteger('jpk')->nullable();
            $table->string('name', 75);
            $table->string('class', 1);
            $table->string('address', 150);
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('fax', 25);
            // No General.Wilayah (region records) module exists yet in this batch - kept as
            // plain descriptive columns rather than a loose FK to a nonexistent table.
            $table->string('region_code', 10)->nullable();
            $table->text('region_name');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppks');
    }
};

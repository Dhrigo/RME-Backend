<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oxygen_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits');
            $table->decimal('flow_rate_lpm', 4, 1);
            $table->string('method');
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oxygen_usages');
    }
};

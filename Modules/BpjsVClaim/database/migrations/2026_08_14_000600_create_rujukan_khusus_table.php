<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Rujukan Khusus extends an existing inter-hospital referral with a specific
        // diagnosis+procedure pair (e.g. hemodialysis/thalassemia repeat visits) rather
        // than issuing a brand new referral, hence no_rujukan_asal instead of patient/visit fields.
        Schema::create('rujukan_khusus', function (Blueprint $table) {
            $table->id();
            $table->string('no_rujukan_asal'); // parent referral number this extends
            $table->string('diagnosa');
            $table->string('kode_prosedur');
            $table->string('no_rujukan_khusus')->nullable()->unique(); // BPJS-assigned
            $table->string('local_status')->default('draft'); // draft/submitted/success/error/deleted
            $table->json('bpjs_response')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rujukan_khusus');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('klaim_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('encounter_local_id')->nullable();
            $table->string('use_case'); // swasta_primary_payor/swasta_secondary_payor/swasta_tpa/swasta_oop/bpjsk/rujukan_pasien
            $table->string('resource_type'); // FHIR resourceType/Bundle submitted
            $table->json('payload');
            $table->foreignId('satu_sehat_staging_submission_id')->nullable()
                ->constrained('satu_sehat_staging_submissions')->nullOnDelete();
            $table->string('status')->default('pending'); // pending/sent/failed
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('klaim_submissions');
    }
};

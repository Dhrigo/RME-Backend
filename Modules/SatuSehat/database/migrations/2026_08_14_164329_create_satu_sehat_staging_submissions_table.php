<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Outbound FHIR submission outbox — buffers a resource/Bundle payload before
     * it's actually POSTed to SATUSEHAT, so a network failure or credential
     * rotation mid-shift doesn't lose the source event; a scheduled job retries
     * anything still 'pending'/'failed'. source_type/source_id point back at the
     * local hospital record (e.g. Pendaftaran\Visit) that produced this resource.
     */
    public function up(): void
    {
        Schema::create('satu_sehat_staging_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('resource_type'); // Encounter, Observation, MedicationRequest, ...
            $table->string('satusehat_id')->nullable(); // FHIR resource id once SATUSEHAT accepts it
            $table->string('source_type'); // e.g. Modules\Pendaftaran\Models\Visit
            $table->unsignedBigInteger('source_id');
            $table->json('payload');
            $table->string('status')->default('pending'); // pending, sent, failed
            $table->unsignedInteger('attempts')->default(0);
            $table->text('last_error')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index(['status']);
            $table->index(['source_type', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satu_sehat_staging_submissions');
    }
};

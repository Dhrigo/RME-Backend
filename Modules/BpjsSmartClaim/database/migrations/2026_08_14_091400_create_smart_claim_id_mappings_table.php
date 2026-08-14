<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Outbound FHIR ID ledger - ported from BPJS\SmartClaim\db\{composition_id,condition_id,
     * diagnostic_report_id,encounter_id,medication_request_id,observation_id,organization_id,
     * patient_id,practitioner_id,procedure_id}\Entity.php in the original ZF2 source, all 10 of
     * which share the identical {id, ref_id} shape (type_code confirmed present on some of the
     * family via the task brief). Modeled here as ONE polymorphic table (ref_type discriminates
     * composition/condition/diagnostic_report/encounter/medication_request/observation/
     * organization/patient/practitioner/procedure) rather than 10 near-empty Eloquent models -
     * same real-world fact (an ID correlation record), one Laravel-idiomatic table.
     */
    public function up(): void
    {
        Schema::create('smart_claim_id_mappings', function (Blueprint $table) {
            $table->uuid('id')->primary(); // the FHIR resource's `id` field used inside the Bundle
            $table->unsignedBigInteger('ref_id'); // local hospital record this FHIR resource represents
            $table->string('ref_type'); // composition/condition/diagnostic_report/encounter/medication_request/observation/organization/patient/practitioner/procedure
            $table->string('type_code')->nullable(); // local entity type ref_id points to, when distinct from ref_type
            $table->timestamps();

            $table->unique(['ref_type', 'ref_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('smart_claim_id_mappings');
    }
};

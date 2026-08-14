<?php

namespace Modules\BpjsSmartClaim\Services;

use Modules\BpjsSmartClaim\Models\SmartClaimIdMapping;

/**
 * Outbound FHIR ID ledger. As a Bundle-builder (e.g. Modules\BpjsRekamMedis) assembles FHIR
 * resources for a Bundle, it calls idFor() to get a stable FHIR resource `id` for each local
 * hospital record it turns into a resource - the same local record always maps to the same
 * FHIR id across submissions, per BPJS SmartClaim's ID-correlation scheme (ported from
 * BPJS\SmartClaim\db\{patient_id,encounter_id,...}\Entity.php in the original ZF2 source).
 */
class SmartClaimIdMappingService
{
    /**
     * Look up (or create) the FHIR resource id for a given local record.
     *
     * @param  string  $refType  composition/condition/diagnostic_report/encounter/medication_request/observation/organization/patient/practitioner/procedure
     * @param  int|string  $refId  the local hospital record id this FHIR resource represents
     * @param  string|null  $typeCode  optional code identifying what local entity type $refId points to
     */
    public function idFor(string $refType, int|string $refId, ?string $typeCode = null): string
    {
        $mapping = SmartClaimIdMapping::query()->firstOrCreate(
            ['ref_type' => $refType, 'ref_id' => $refId],
            ['type_code' => $typeCode],
        );

        return $mapping->id;
    }
}

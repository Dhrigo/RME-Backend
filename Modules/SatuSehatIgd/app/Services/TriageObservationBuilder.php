<?php

namespace Modules\SatuSehatIgd\Services;

/**
 * Builds the FHIR Observation resource for IGD triage (Canadian Triage and
 * Acuity Scale, LOINC 75910-0). Structure ported field-for-field from the
 * observed "POST Observation - Kondisi Pasien Tiba" request in
 * kemkes_research_findings.md section 3.4 (SATUSEHAT public Postman
 * collection "03. Pelayanan - IGD"), which is itself the CTAS Observation
 * example (category=survey, code=LOINC 75910-0, valueCodeableConcept=LOINC
 * LA6113-0 "2").
 */
class TriageObservationBuilder
{
    public function build(array $data): array
    {
        return [
            'resourceType' => 'Observation',
            'status' => 'final',
            'category' => [
                [
                    'coding' => [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                            'code' => 'survey',
                            'display' => 'Survey',
                        ],
                    ],
                ],
            ],
            'code' => [
                'coding' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => '75910-0',
                        'display' => 'Canadian triage and acuity scale [CTAS]',
                    ],
                ],
            ],
            'subject' => [
                'reference' => "Patient/{$data['patient_id']}",
                'display' => $data['patient_name'],
            ],
            'encounter' => [
                'reference' => "Encounter/{$data['encounter_id']}",
            ],
            'effectiveDateTime' => $data['effective_date_time'],
            'issued' => $data['effective_date_time'],
            'performer' => [
                ['reference' => "Practitioner/{$data['practitioner_id']}"],
            ],
            'valueCodeableConcept' => [
                'coding' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => $data['triage_loinc_code'],
                        'display' => $data['triage_level_display'],
                    ],
                ],
            ],
        ];
    }
}

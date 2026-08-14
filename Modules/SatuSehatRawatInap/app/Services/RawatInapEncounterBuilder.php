<?php

namespace Modules\SatuSehatRawatInap\Services;

/**
 * Builds the FHIR Encounter resource for admission into inpatient care (rawat
 * inap). Structure ported field-for-field from the observed "POST Encounter -
 * Masuk Kunjungan Rawat Inap" request in kemkes_research_findings.md section
 * 3.3 (SATUSEHAT public Postman collection "02. Pelayanan - Rawat Inap").
 * class.code is fixed to "IMP" (inpatient encounter). Unlike RawatJalan,
 * location has no separate period block and an optional basedOn reference to
 * the pre-admission ServiceRequest (Pra Ranap) is supported.
 */
class RawatInapEncounterBuilder
{
    public function build(array $data): array
    {
        $orgId = config('satusehat.organization_id');

        $encounter = [
            'resourceType' => 'Encounter',
            'identifier' => [
                [
                    'system' => "http://sys-ids.kemkes.go.id/encounter/{$orgId}",
                    'value' => $data['registration_id'],
                ],
            ],
            'status' => 'in-progress',
            'class' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'code' => 'IMP',
                'display' => 'inpatient encounter',
            ],
            'serviceType' => [
                'coding' => [
                    [
                        'system' => 'http://terminology.hl7.org/CodeSystem/service-type',
                        'code' => $data['service_type_code'],
                        'display' => $data['service_type_display'],
                    ],
                ],
            ],
            'subject' => [
                'reference' => "Patient/{$data['patient_id']}",
                'display' => $data['patient_name'],
            ],
            'participant' => [
                [
                    'type' => [
                        [
                            'coding' => [
                                [
                                    'system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                                    'code' => 'ATND',
                                    'display' => 'attender',
                                ],
                            ],
                        ],
                    ],
                    'individual' => [
                        'reference' => "Practitioner/{$data['practitioner_id']}",
                        'display' => $data['practitioner_name'],
                    ],
                ],
            ],
            'period' => [
                'start' => $data['period_start'],
            ],
            'location' => [
                [
                    'location' => [
                        'reference' => "Location/{$data['bed_location_id']}",
                        'display' => $data['bed_location_name'],
                    ],
                    'extension' => [
                        [
                            'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/ServiceClass',
                            'extension' => [
                                [
                                    'url' => 'value',
                                    'valueCodeableConcept' => [
                                        'coding' => [
                                            [
                                                'system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                                                'code' => $data['service_class_code'] ?? '1',
                                                'display' => $data['service_class_display'] ?? 'Kelas 1',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'url' => 'upgradeClassIndicator',
                                    'valueCodeableConcept' => [
                                        'coding' => [
                                            [
                                                'system' => 'http://terminology.kemkes.go.id/CodeSystem/locationUpgradeClass',
                                                'code' => $data['upgrade_class_code'] ?? 'kelas-tetap',
                                                'display' => $data['upgrade_class_display'] ?? 'Kelas Tetap Perawatan',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'statusHistory' => [
                [
                    'status' => 'in-progress',
                    'period' => [
                        'start' => $data['period_start'],
                    ],
                ],
            ],
            'serviceProvider' => [
                'reference' => "Organization/{$orgId}",
            ],
        ];

        if (! empty($data['service_request_id'])) {
            $encounter['basedOn'] = [
                ['reference' => "ServiceRequest/{$data['service_request_id']}"],
            ];
        }

        return $encounter;
    }
}

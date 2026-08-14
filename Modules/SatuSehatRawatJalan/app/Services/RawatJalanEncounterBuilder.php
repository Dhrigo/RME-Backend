<?php

namespace Modules\SatuSehatRawatJalan\Services;

/**
 * Builds the FHIR Encounter resource for a new outpatient (rawat jalan) visit.
 * Structure ported field-for-field from the observed "POST Encounter - Kunjungan
 * Baru" request in kemkes_research_findings.md section 3.2 (SATUSEHAT public
 * Postman collection "01. Pelayanan - Rawat Jalan"). class.code is fixed to
 * "AMB" (ambulatory) - the defining trait of this module versus RawatInap (IMP).
 */
class RawatJalanEncounterBuilder
{
    public function build(array $data): array
    {
        $orgId = config('satusehat.organization_id');

        return [
            'resourceType' => 'Encounter',
            'identifier' => [
                [
                    'system' => "http://sys-ids.kemkes.go.id/encounter/{$orgId}",
                    'value' => $data['registration_id'],
                ],
            ],
            'status' => 'arrived',
            'class' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'code' => 'AMB',
                'display' => 'ambulatory',
            ],
            'serviceType' => [
                'coding' => [
                    [
                        'system' => 'http://snomed.info.sct',
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
                        'reference' => "Location/{$data['location_id']}",
                        'display' => $data['location_name'],
                    ],
                    'period' => [
                        'start' => $data['period_start'],
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
                                                'system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Outpatient',
                                                'code' => $data['service_class_code'] ?? 'reguler',
                                                'display' => $data['service_class_display'] ?? 'Kelas Reguler',
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
                    'status' => 'arrived',
                    'period' => [
                        'start' => $data['period_start'],
                    ],
                ],
            ],
            'serviceProvider' => [
                'reference' => "Organization/{$orgId}",
            ],
        ];
    }
}

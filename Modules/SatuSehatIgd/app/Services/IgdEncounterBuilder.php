<?php

namespace Modules\SatuSehatIgd\Services;

/**
 * Builds the FHIR Encounter resource for an IGD (emergency) visit.
 *
 * NOTE: the SATUSEHAT public Postman collection "03. Pelayanan - IGD" (see
 * kemkes_research_findings.md section 3.4) documents the "02. Pendaftaran
 * Kunjungan IGD" folder by name only - no literal request JSON was captured
 * for it during research. The envelope below reuses the identical
 * identifier/status/class/serviceType/subject/participant/period/location/
 * statusHistory/serviceProvider shape that WAS captured verbatim for both
 * RawatJalan (class.code=AMB) and RawatInap (class.code=IMP), since all three
 * folders sit under the same "Membuat Struktur Organisasi dan Lokasi" +
 * "Pendaftaran Kunjungan" pattern. class.code=EMER is the standard HL7
 * v3-ActCode value for "emergency" in the SAME CodeSystem SATUSEHAT already
 * confirmed using for AMB/IMP - it was not independently observed in a
 * captured IGD request body. Flagged in the final report as needing a live
 * IGD Encounter payload cross-check before production use.
 */
class IgdEncounterBuilder
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
                'code' => 'EMER',
                'display' => 'emergency',
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
                        'reference' => "Location/{$data['location_id']}",
                        'display' => $data['location_name'],
                    ],
                    'period' => [
                        'start' => $data['period_start'],
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

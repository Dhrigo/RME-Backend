<?php

namespace Modules\SatuSehatFarmasi\Services;

/**
 * Builds the FHIR MedicationRequest resource (with an inline contained
 * Medication resource) for a prescription. Structure ported field-for-field
 * from the observed "POST MedicationRequest - Resep Obat Non Racik Generik -
 * Paracetamol" request in kemkes_research_findings.md section 3.5
 * (SATUSEHAT public Postman collection "04. Pelayanan - Farmasi"), including
 * the KFA code example 93006334 (Paracetamol 500 mg Tablet).
 */
class MedicationRequestBuilder
{
    public function build(array $data): array
    {
        $orgId = config('satusehat.organization_id');
        $containedId = "{$data['registration_id']}-001";

        $medicationRequest = [
            'resourceType' => 'MedicationRequest',
            'contained' => [
                [
                    'resourceType' => 'Medication',
                    'meta' => [
                        'profile' => ['https://fhir.kemkes.go.id/r4/StructureDefinition/Medication'],
                    ],
                    'id' => $containedId,
                    'identifier' => [
                        [
                            'system' => "http://sys-ids.kemkes.go.id/medication/{$orgId}",
                            'use' => 'official',
                            'value' => $data['medication_local_code'],
                        ],
                    ],
                    'code' => [
                        'coding' => [
                            [
                                'system' => 'http://sys-ids.kemkes.go.id/kfa',
                                'code' => $data['kfa_code'],
                                'display' => $data['kfa_display'],
                            ],
                        ],
                    ],
                    'status' => 'active',
                    'form' => [
                        'coding' => [
                            [
                                'system' => 'http://terminology.kemkes.go.id/CodeSystem/medication-form',
                                'code' => $data['form_code'],
                                'display' => $data['form_display'],
                            ],
                        ],
                    ],
                    'ingredient' => [
                        [
                            'itemCodeableConcept' => [
                                'coding' => [
                                    [
                                        'system' => 'http://sys-ids.kemkes.go.id/kfa',
                                        'code' => $data['ingredient_kfa_code'],
                                        'display' => $data['ingredient_display'],
                                    ],
                                ],
                            ],
                            'isActive' => true,
                            'strength' => [
                                'numerator' => [
                                    'system' => 'http://unitsofmeasure.org',
                                    'value' => $data['strength_value'],
                                    'code' => $data['strength_unit_code'],
                                ],
                                'denominator' => [
                                    'value' => 1,
                                    'unit' => $data['form_display'],
                                    'system' => 'http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm',
                                    'code' => $data['dose_unit_code'],
                                ],
                            ],
                        ],
                    ],
                    'extension' => [
                        [
                            'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/MedicationType',
                            'valueCodeableConcept' => [
                                'coding' => [
                                    [
                                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/medication-type',
                                        'code' => $data['medication_type_code'] ?? 'NC',
                                        'display' => $data['medication_type_display'] ?? 'Non-compound',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'identifier' => [
                [
                    'system' => "http://sys-ids.kemkes.go.id/prescription/{$orgId}",
                    'use' => 'official',
                    'value' => $data['prescription_number'],
                ],
                [
                    'system' => "http://sys-ids.kemkes.go.id/prescription-item/{$orgId}",
                    'use' => 'official',
                    'value' => "{$data['prescription_number']}-1",
                ],
            ],
            'status' => 'completed',
            'intent' => 'order',
            'category' => [
                [
                    'coding' => [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/medicationrequest-category',
                            'code' => $data['category_code'] ?? 'community',
                            'display' => $data['category_display'] ?? 'Community',
                        ],
                    ],
                ],
            ],
            'priority' => $data['priority'] ?? 'routine',
            'medicationReference' => [
                'reference' => "#{$containedId}",
            ],
            'subject' => [
                'reference' => "Patient/{$data['patient_id']}",
                'display' => $data['patient_name'],
            ],
            'encounter' => [
                'reference' => "Encounter/{$data['encounter_id']}",
            ],
            'authoredOn' => $data['authored_on'],
            'requester' => [
                'reference' => "Practitioner/{$data['practitioner_id']}",
                'display' => $data['practitioner_name'],
            ],
            'dosageInstruction' => [
                [
                    'sequence' => 1,
                    'patientInstruction' => $data['patient_instruction'],
                    'timing' => [
                        'repeat' => [
                            'frequency' => $data['timing_frequency'],
                            'period' => $data['timing_period'],
                            'periodUnit' => $data['timing_period_unit'],
                        ],
                    ],
                    'route' => [
                        'coding' => [
                            [
                                'system' => 'http://www.whocc.no/atc',
                                'code' => $data['route_code'] ?? 'O',
                                'display' => $data['route_display'] ?? 'Oral',
                            ],
                        ],
                    ],
                    'doseAndRate' => [
                        [
                            'type' => [
                                'coding' => [
                                    [
                                        'system' => 'http://terminology.hl7.org/CodeSystem/dose-rate-type',
                                        'code' => 'ordered',
                                        'display' => 'Ordered',
                                    ],
                                ],
                            ],
                            'doseQuantity' => [
                                'value' => $data['dose_value'],
                                'unit' => $data['dose_unit_code'],
                                'system' => 'http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm',
                                'code' => $data['dose_unit_code'],
                            ],
                        ],
                    ],
                ],
            ],
            'dispenseRequest' => [
                'validityPeriod' => [
                    'start' => $data['dispense_start'],
                    'end' => $data['dispense_end'],
                ],
                'numberOfRepeatsAllowed' => $data['number_of_repeats_allowed'] ?? 1,
                'quantity' => [
                    'value' => $data['dispense_quantity'],
                    'unit' => $data['dose_unit_code'],
                    'system' => 'http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm',
                    'code' => $data['dose_unit_code'],
                ],
                'performer' => [
                    'reference' => "Organization/{$orgId}",
                ],
            ],
        ];

        if (! empty($data['reason_condition_id'])) {
            $medicationRequest['reasonReference'] = [
                [
                    'reference' => "Condition/{$data['reason_condition_id']}",
                    'display' => $data['reason_display'] ?? null,
                ],
            ];
        }

        return $medicationRequest;
    }
}

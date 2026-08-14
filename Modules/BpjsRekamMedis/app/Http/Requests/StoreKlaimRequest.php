<?php

namespace Modules\BpjsRekamMedis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates the "submit medical record bundle for this SEP" request. The upstream data
 * (patient/encounter/practitioner/... local record ids and their FHIR-relevant fields) is
 * passed in directly by the caller rather than looked up from a specific module here - see
 * Modules\BpjsRekamMedis\Data\MedicalRecordBundleData for the scope-boundary note.
 */
class StoreKlaimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_sep' => ['required', 'string'],
            'jenis_pelayanan_id' => ['required', 'string'],
            'bulan' => ['required', 'string'],
            'tahun' => ['required', 'string'],

            'composition' => ['required', 'array'],
            'composition.title' => ['required', 'string'],
            'composition.date' => ['required', 'string'],

            'patient' => ['required', 'array'],
            'patient.id' => ['required', 'integer'],
            'patient.mr_number' => ['required', 'string'],
            'patient.name' => ['required', 'string'],
            'patient.gender' => ['required', 'string'],
            'patient.birth_date' => ['required', 'string'],
            'patient.marital_status_code' => ['nullable', 'string'],

            'encounter' => ['required', 'array'],
            'encounter.id' => ['required', 'integer'],
            'encounter.status' => ['required', 'string'],
            'encounter.class_code' => ['required', 'string'],

            'practitioner' => ['required', 'array'],
            'practitioner.id' => ['required', 'integer'],
            'practitioner.name' => ['required', 'string'],
            'practitioner.identifier' => ['required', 'string'],

            'organization' => ['required', 'array'],
            'organization.id' => ['required', 'integer'],
            'organization.name' => ['required', 'string'],
            'organization.identifier' => ['required', 'string'],

            'conditions' => ['array'],
            'conditions.*.id' => ['required', 'integer'],
            'conditions.*.code' => ['required', 'string'],
            'conditions.*.display' => ['nullable', 'string'],

            'diagnostic_reports' => ['array'],
            'diagnostic_reports.*.id' => ['required', 'integer'],
            'diagnostic_reports.*.code' => ['required', 'string'],
            'diagnostic_reports.*.status' => ['required', 'string'],

            'procedures' => ['array'],
            'procedures.*.id' => ['required', 'integer'],
            'procedures.*.code' => ['required', 'string'],
            'procedures.*.status' => ['required', 'string'],

            'medication_requests' => ['array'],
            'medication_requests.*.id' => ['required', 'integer'],
            'medication_requests.*.code' => ['required', 'string'],
            'medication_requests.*.status' => ['required', 'string'],
            'medication_requests.*.intent' => ['required', 'string'],

            'devices' => ['array'],
            'devices.*.id' => ['required', 'integer'],
            'devices.*.type' => ['required', 'string'],
        ];
    }
}

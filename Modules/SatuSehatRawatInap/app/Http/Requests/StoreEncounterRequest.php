<?php

namespace Modules\SatuSehatRawatInap\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEncounterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_id' => ['required', 'string'],
            'patient_id' => ['required', 'string'],
            'patient_name' => ['required', 'string'],
            'practitioner_id' => ['required', 'string'],
            'practitioner_name' => ['required', 'string'],
            'period_start' => ['required', 'date'],
            'bed_location_id' => ['required', 'string'],
            'bed_location_name' => ['required', 'string'],
            'service_type_code' => ['required', 'string'],
            'service_type_display' => ['required', 'string'],
            'service_class_code' => ['nullable', 'string'],
            'service_class_display' => ['nullable', 'string'],
            'upgrade_class_code' => ['nullable', 'string'],
            'upgrade_class_display' => ['nullable', 'string'],
            'service_request_id' => ['nullable', 'string'],
        ];
    }
}

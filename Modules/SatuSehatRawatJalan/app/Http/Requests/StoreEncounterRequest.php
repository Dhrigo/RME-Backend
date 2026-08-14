<?php

namespace Modules\SatuSehatRawatJalan\Http\Requests;

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
            'location_id' => ['required', 'string'],
            'location_name' => ['required', 'string'],
            'service_type_code' => ['required', 'string'],
            'service_type_display' => ['required', 'string'],
            'service_class_code' => ['nullable', 'string'],
            'service_class_display' => ['nullable', 'string'],
            'upgrade_class_code' => ['nullable', 'string'],
            'upgrade_class_display' => ['nullable', 'string'],
        ];
    }
}

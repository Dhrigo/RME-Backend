<?php

namespace Modules\SatuSehatFarmasi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicationRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_id' => ['required', 'string'],
            'prescription_number' => ['required', 'string'],
            'patient_id' => ['required', 'string'],
            'patient_name' => ['required', 'string'],
            'encounter_id' => ['required', 'string'],
            'practitioner_id' => ['required', 'string'],
            'practitioner_name' => ['required', 'string'],
            'authored_on' => ['required', 'date'],

            'medication_local_code' => ['required', 'string'],
            'kfa_code' => ['required', 'string'],
            'kfa_display' => ['required', 'string'],
            'form_code' => ['required', 'string'],
            'form_display' => ['required', 'string'],
            'ingredient_kfa_code' => ['required', 'string'],
            'ingredient_display' => ['required', 'string'],
            'strength_value' => ['required', 'numeric'],
            'strength_unit_code' => ['required', 'string'],
            'medication_type_code' => ['nullable', 'string'],
            'medication_type_display' => ['nullable', 'string'],

            'category_code' => ['nullable', 'string'],
            'category_display' => ['nullable', 'string'],
            'priority' => ['nullable', 'string'],
            'patient_instruction' => ['required', 'string'],
            'timing_frequency' => ['required', 'integer'],
            'timing_period' => ['required', 'integer'],
            'timing_period_unit' => ['required', 'string'],
            'route_code' => ['nullable', 'string'],
            'route_display' => ['nullable', 'string'],
            'dose_value' => ['required', 'numeric'],
            'dose_unit_code' => ['required', 'string'],

            'dispense_start' => ['required', 'date'],
            'dispense_end' => ['required', 'date'],
            'number_of_repeats_allowed' => ['nullable', 'integer'],
            'dispense_quantity' => ['required', 'numeric'],

            'reason_condition_id' => ['nullable', 'string'],
            'reason_display' => ['nullable', 'string'],
        ];
    }
}

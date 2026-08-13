<?php

namespace Modules\LayananBirthRecord\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBirthRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'mother_patient_id' => ['required', 'integer', 'exists:patients,id'],
            'baby_name' => ['nullable', 'string', 'max:255'],
            'gender_id' => ['nullable', 'integer', 'exists:genders,id'],
            'birth_date' => ['required', 'date'],
            'birth_weight_grams' => ['nullable', 'integer'],
            'birth_length_cm' => ['nullable', 'numeric'],
            'delivery_method' => ['required', Rule::in(['normal', 'cesarean', 'assisted'])],
            'attending_doctor_id' => ['nullable', 'integer', 'exists:employees,id'],
            'notes' => ['nullable', 'string'],
        ];
    }
}

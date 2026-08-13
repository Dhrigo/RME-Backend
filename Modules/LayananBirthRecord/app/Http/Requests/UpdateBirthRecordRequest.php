<?php

namespace Modules\LayananBirthRecord\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBirthRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'mother_patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'baby_name' => ['sometimes', 'string', 'max:255'],
            'gender_id' => ['sometimes', 'integer', 'exists:genders,id'],
            'birth_date' => ['sometimes', 'date'],
            'birth_weight_grams' => ['sometimes', 'integer'],
            'birth_length_cm' => ['sometimes', 'numeric'],
            'delivery_method' => ['sometimes', Rule::in(['normal', 'cesarean', 'assisted'])],
            'attending_doctor_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'notes' => ['sometimes', 'string'],
        ];
    }
}

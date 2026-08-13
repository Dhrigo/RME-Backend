<?php

namespace Modules\MedicalRecordChiefComplaint\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChiefComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'complaint' => ['nullable', 'string'],
            'onset' => ['nullable', 'string', 'max:100'],
            'duration' => ['nullable', 'string', 'max:100'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
        ];
    }
}

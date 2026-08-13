<?php

namespace Modules\MedicalRecordChiefComplaint\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChiefComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'complaint' => ['nullable', 'string'],
            'onset' => ['nullable', 'string', 'max:100'],
            'duration' => ['nullable', 'string', 'max:100'],
            'recorded_by' => ['required', 'integer', 'exists:employees,id'],
            'recorded_at' => ['required', 'date'],
        ];
    }
}

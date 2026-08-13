<?php

namespace Modules\MedicalRecordSurgeryPerformer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurgeryPerformerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'surgery_id' => 'nullable|integer',
            'visit_id' => 'nullable|integer',
            'doctor_id' => 'nullable|integer',
            'role' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:255',
        ];
    }
}

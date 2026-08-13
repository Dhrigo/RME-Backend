<?php

namespace Modules\PendaftaranApplicant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranApplicant\Models\Applicant;

class UpdateApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['sometimes', 'string', 'max:255'],
            'relationship_to_patient' => ['sometimes', Rule::in(Applicant::RELATIONSHIP_TYPES)],
            'identity_number' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'application_type' => ['sometimes', Rule::in(Applicant::APPLICATION_TYPES)],
            'application_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}

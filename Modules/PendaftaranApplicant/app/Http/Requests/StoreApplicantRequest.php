<?php

namespace Modules\PendaftaranApplicant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranApplicant\Models\Applicant;

class StoreApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_id' => ['required', 'integer', 'exists:registrations,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'relationship_to_patient' => ['required', Rule::in(Applicant::RELATIONSHIP_TYPES)],
            'identity_number' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'application_type' => ['required', Rule::in(Applicant::APPLICATION_TYPES)],
            'application_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}

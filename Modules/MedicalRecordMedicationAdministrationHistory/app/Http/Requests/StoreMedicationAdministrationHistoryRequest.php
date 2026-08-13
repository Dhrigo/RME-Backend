<?php

namespace Modules\MedicalRecordMedicationAdministrationHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicationAdministrationHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'administered_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'drug_name' => ['required','string','max:255'],
            'dose' => ['nullable','string','max:50'],
            'route' => ['nullable','string','max:30'],
            'administered_at' => ['nullable','date'],
            'notes' => ['nullable','string'],
        ];
    }
}

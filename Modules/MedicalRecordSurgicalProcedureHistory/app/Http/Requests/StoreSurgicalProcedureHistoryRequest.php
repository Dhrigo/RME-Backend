<?php

namespace Modules\MedicalRecordSurgicalProcedureHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurgicalProcedureHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'procedure_name' => ['required','string','max:255'],
            'procedure_date' => ['nullable','date'],
            'facility_name' => ['nullable','string','max:255'],
            'surgeon_name' => ['nullable','string','max:255'],
            'complications' => ['nullable','string'],
        ];
    }
}

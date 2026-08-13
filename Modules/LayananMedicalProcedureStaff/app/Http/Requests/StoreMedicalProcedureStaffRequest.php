<?php

namespace Modules\LayananMedicalProcedureStaff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalProcedureStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'medical_procedure_id' => ['required', 'integer', 'exists:medical_procedures,id'],
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'role' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ];
    }
}

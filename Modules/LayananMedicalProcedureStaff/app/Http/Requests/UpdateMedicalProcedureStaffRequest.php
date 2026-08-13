<?php

namespace Modules\LayananMedicalProcedureStaff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicalProcedureStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'medical_procedure_id' => ['sometimes', 'integer', 'exists:medical_procedures,id'],
            'employee_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'role' => ['sometimes', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ];
    }
}

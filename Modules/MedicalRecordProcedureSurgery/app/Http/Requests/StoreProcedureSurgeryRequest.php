<?php

namespace Modules\MedicalRecordProcedureSurgery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedureSurgeryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'procedure_id' => 'nullable|integer',
            'surgery_name' => 'required|string|max:255',
            'surgery_type' => 'nullable|string|max:100',
            'anesthesia_type' => 'nullable|string|max:100',
            'performed_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }
}

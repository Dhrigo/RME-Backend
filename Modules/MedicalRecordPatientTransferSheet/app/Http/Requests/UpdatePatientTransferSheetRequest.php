<?php

namespace Modules\MedicalRecordPatientTransferSheet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientTransferSheetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'patient_id' => 'sometimes|required|integer',
            'from_ward_id' => 'nullable|integer',
            'to_ward_id' => 'nullable|integer',
            'transfer_reason' => 'nullable|string',
            'patient_condition' => 'nullable|string',
            'transferred_at' => 'nullable|date',
            'transferred_by' => 'nullable|integer',
        ];
    }
}

<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferMedicationReconciliationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'reconciled_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'transferred_to_ward_id' => ['required', 'integer', 'exists:wards,id'],
            'source_of_medication_list' => ['nullable','string','max:255'],
            'notes' => ['nullable','string'],
            'status' => ['nullable','in:draft,completed'],
            'reconciled_at' => ['nullable','date'],
        ];
    }
}

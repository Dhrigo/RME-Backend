<?php

namespace Modules\MedicalRecordAdmissionMedicationReconciliationItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmissionMedicationReconciliationItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reconciliation_id' => ['required', 'integer', 'exists:admission_medication_reconciliations,id'],
            'drug_name' => ['required','string','max:255'],
            'dose' => ['nullable','string','max:50'],
            'frequency' => ['nullable','string','max:50'],
            'route' => ['nullable','string','max:30'],
            'action' => ['required','in:continue,hold,discontinue,modify,new'],
            'reason' => ['nullable','string','max:255'],
            'last_taken_at' => ['nullable','date'],
        ];
    }
}

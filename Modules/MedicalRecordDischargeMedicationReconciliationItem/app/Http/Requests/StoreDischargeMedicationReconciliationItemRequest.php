<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliationItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDischargeMedicationReconciliationItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reconciliation_id' => ['required', 'integer', 'exists:discharge_medication_reconciliations,id'],
            'drug_name' => ['required','string','max:255'],
            'dose' => ['nullable','string','max:50'],
            'frequency' => ['nullable','string','max:50'],
            'route' => ['nullable','string','max:30'],
            'action' => ['required','in:continue,hold,discontinue,modify,new'],
            'reason' => ['nullable','string','max:255'],
            'patient_education_given' => ['nullable','boolean'],
        ];
    }
}

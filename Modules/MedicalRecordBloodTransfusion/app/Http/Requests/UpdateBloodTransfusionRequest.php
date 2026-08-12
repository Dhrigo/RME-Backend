<?php

namespace Modules\MedicalRecordBloodTransfusion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBloodTransfusionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:in_progress,completed,stopped_reaction,cancelled'],
            'ended_at' => ['nullable', 'date'],
            'reaction_notes' => ['nullable', 'string'],
        ];
    }
}

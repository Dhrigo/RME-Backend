<?php

namespace Modules\MedicalRecordSurgery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSurgeryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:scheduled,in_progress,completed,cancelled'],
            'ended_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}

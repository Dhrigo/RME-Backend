<?php

namespace Modules\PendaftaranBedQueue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBedQueueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bed_id' => ['required', 'integer', 'exists:beds,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'queue_number' => ['required', 'integer', 'min:1'],
        ];
    }
}

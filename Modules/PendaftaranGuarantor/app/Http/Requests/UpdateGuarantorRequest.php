<?php

namespace Modules\PendaftaranGuarantor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class UpdateGuarantorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payer_type' => ['sometimes', Rule::in(Guarantor::PAYER_TYPES)],
            'member_number' => ['nullable', 'string', 'max:255'],
            'room_class_id' => ['nullable', 'integer', 'exists:room_classes,id'],
            'reference_letter_number' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}

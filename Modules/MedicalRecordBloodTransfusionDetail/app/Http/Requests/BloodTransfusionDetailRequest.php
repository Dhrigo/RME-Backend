<?php

namespace Modules\MedicalRecordBloodTransfusionDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodTransfusionDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transfusion_id' => ['required', 'integer', 'exists:blood_transfusions,id'],
            'blood_bag_number' => ['required', 'string', 'max:255'],
            'blood_type' => ['nullable', 'string', 'max:50'],
            'volume_ml' => ['required', 'integer', 'min:1'],
            'start_time' => ['nullable', 'date'],
            'end_time' => ['nullable', 'date'],
            'reaction_observed' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:100'],
        ];
    }
}

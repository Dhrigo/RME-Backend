<?php

namespace Modules\GeneralOtherServiceTariff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOtherServiceTariffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'other_service_id' => ['sometimes', 'integer', 'exists:other_services,id'],
            'room_class_id' => ['nullable', 'integer', 'exists:room_classes,id'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}

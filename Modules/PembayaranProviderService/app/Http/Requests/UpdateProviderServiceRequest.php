<?php

namespace Modules\PembayaranProviderService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranProviderService\Models\ProviderService;

class UpdateProviderServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('provider_service')?->id;

        return [
            'payment_provider_id' => ['sometimes', 'integer', 'exists:payment_providers,id'],
            'service_code' => ['nullable', 'string', 'max:255', Rule::unique('provider_services', 'service_code')->ignore($id)],
            'service_name' => ['sometimes', 'string', 'max:255'],
            'service_type' => ['sometimes', Rule::in(ProviderService::SERVICE_TYPES)],
            'admin_fee_type' => ['sometimes', Rule::in(ProviderService::ADMIN_FEE_TYPES)],
            'admin_fee_amount' => ['sometimes', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}

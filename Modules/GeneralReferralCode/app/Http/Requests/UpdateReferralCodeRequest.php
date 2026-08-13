<?php

namespace Modules\GeneralReferralCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReferralCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['sometimes', 'string', 'max:255', 'unique:referral_codes,code'],
            'name' => ['sometimes', 'string', 'max:255'],
            'category' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}

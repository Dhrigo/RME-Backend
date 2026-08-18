<?php

namespace Modules\PegawaiEmployeeContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contact_type' => ['sometimes', 'string', 'in:telepon_rumah,telepon_kantor,telepon_seluler,faks_rumah,faks_kantor,email,situs_web,media_sosial'],
            'value' => ['sometimes', 'string', 'max:255'],
        ];
    }
}

<?php

namespace Modules\PegawaiEmployeeContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'contact_type' => ['required', 'string', 'in:telepon_rumah,telepon_kantor,telepon_seluler,faks_rumah,faks_kantor,email,situs_web,media_sosial'],
            'value' => ['required', 'string', 'max:255'],
        ];
    }
}

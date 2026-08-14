<?php

namespace Modules\BpjsAntreanFktp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Mirrors BPJS's confirmed "Update Waktu Antrean" payload (antrean/updatewaktu).
 * taskid 1-7 = timeline states, 99 = tidak hadir/batal. jenis_resep only sent
 * to BPJS when this hospital has pharmacy-queue integration.
 */
class StoreAntreanWaktuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_id' => ['required', 'integer', 'in:1,2,3,4,5,6,7,99'],
            'waktu' => ['nullable', 'date'],
            'jenis_resep' => ['nullable', 'string', 'max:50'],
        ];
    }
}

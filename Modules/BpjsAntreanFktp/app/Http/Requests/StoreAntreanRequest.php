<?php

namespace Modules\BpjsAntreanFktp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Fields mirror BPJS's confirmed "Tambah Antrean" payload (antrean/add), minus
 * kodebooking (generated server-side) and the fields BPJS returns/derives
 * (namapoli/namadokter looked up locally if omitted).
 */
class StoreAntreanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'jenispasien' => ['required', 'string', 'in:JKN,NON JKN'],
            'nomorkartu' => ['nullable', 'string', 'max:20'],
            'nik' => ['nullable', 'string', 'max:20'],
            'nohp' => ['nullable', 'string', 'max:20'],
            'kodepoli' => ['required', 'string', 'max:10'],
            'namapoli' => ['nullable', 'string', 'max:100'],
            'pasienbaru' => ['boolean'],
            'norm' => ['nullable', 'string', 'max:20'],
            'tanggalperiksa' => ['required', 'date'],
            'kodedokter' => ['required', 'integer'],
            'namadokter' => ['nullable', 'string', 'max:100'],
            'jampraktek' => ['required', 'string', 'max:30'],
            'jeniskunjungan' => ['required', 'integer', 'in:1,2,3,4'],
            'nomorreferensi' => ['nullable', 'string', 'max:50'],
            'nomorantrean' => ['required', 'string', 'max:20'],
            'angkaantrean' => ['required', 'integer'],
            'estimasidilayani' => ['required', 'date'],
            'sisakuotajkn' => ['nullable', 'integer'],
            'kuotajkn' => ['nullable', 'integer'],
            'sisakuotanonjkn' => ['nullable', 'integer'],
            'kuotanonjkn' => ['nullable', 'integer'],
            'keterangan' => ['nullable', 'string'],
        ];
    }
}

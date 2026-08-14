<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * One request covers all 4 SEP creation flows (IGD / Rujukan Kunjungan Pertama /
 * Rujukan Kunjungan Kedua+ / Rawat Inap) - required fields differ per visit_type,
 * matching the distinct field sets the PDF guide documents for each flow.
 */
class StoreSepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $visitType = $this->input('visit_type');

        return [
            'visit_type' => ['required', 'string', 'in:igd,rujukan_pertama,rujukan_lanjutan,rawat_inap'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'no_kartu' => ['required', 'string'],
            'no_rujukan' => [$visitType === 'igd' ? 'prohibited' : 'required', 'string'],
            'tgl_sep' => ['required', 'date'],
            'poli_tujuan' => [in_array($visitType, ['rujukan_lanjutan'], true) ? 'required' : 'nullable', 'string'],
            'kelas_rawat' => [$visitType === 'rawat_inap' ? 'required' : 'nullable', 'string'],
            'dpjp_doctor_id' => [$visitType === 'rujukan_lanjutan' ? 'nullable' : 'required', 'integer', 'exists:doctors,id'],
            'diagnosa_awal' => [in_array($visitType, ['igd', 'rawat_inap'], true) ? 'required' : 'nullable', 'string'],
            'catatan' => ['nullable', 'string'],
            'no_surat_kontrol' => ['nullable', 'string'],
            'status_kecelakaan' => ['required', 'string', 'in:0,1,2,3'],
            'kecelakaan_provinsi_code' => [$this->requiresAccidentRegion() ? 'required' : 'nullable', 'string'],
            'kecelakaan_kabupaten_code' => [$this->requiresAccidentRegion() ? 'required' : 'nullable', 'string'],
            'kecelakaan_kecamatan_code' => [$this->requiresAccidentRegion() ? 'required' : 'nullable', 'string'],
            'suplesi_jasa_raharja' => ['nullable', 'boolean'],
        ];
    }

    private function requiresAccidentRegion(): bool
    {
        return $this->input('status_kecelakaan') !== '0' && $this->input('status_kecelakaan') !== null;
    }
}

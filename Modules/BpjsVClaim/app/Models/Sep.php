<?php

namespace Modules\BpjsVClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\BpjsVClaim\Database\Factories\SepFactory;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralPatient\Models\Patient;

class Sep extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_type',
        'patient_id',
        'no_kartu',
        'no_rujukan',
        'no_sep',
        'tgl_sep',
        'poli_tujuan',
        'kelas_rawat',
        'dpjp_doctor_id',
        'diagnosa_awal',
        'catatan',
        'no_surat_kontrol',
        'status_kecelakaan',
        'kecelakaan_provinsi_code',
        'kecelakaan_kabupaten_code',
        'kecelakaan_kecamatan_code',
        'suplesi_jasa_raharja',
        'local_status',
        'bpjs_response',
        'error_message',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'tgl_sep' => 'date',
            'suplesi_jasa_raharja' => 'boolean',
            'bpjs_response' => 'array',
            'submitted_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function dpjpDoctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'dpjp_doctor_id');
    }

    public function pengajuans(): HasMany
    {
        return $this->hasMany(SepPengajuan::class);
    }

    public function rencanaKontrols(): HasMany
    {
        return $this->hasMany(RencanaKontrol::class);
    }

    public function spris(): HasMany
    {
        return $this->hasMany(Spri::class);
    }

    protected static function newFactory(): SepFactory
    {
        return SepFactory::new();
    }
}

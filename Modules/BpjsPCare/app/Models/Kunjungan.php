<?php

namespace Modules\BpjsPCare\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\BpjsPCare\Database\Factories\KunjunganFactory;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftaran_id',
        'nomor_kunjungan',
        'no_kartu',
        'tanggal_kunjungan',
        'jenis_kunjungan',
        'kode_poli',
        'kode_dokter',
        'no_rujukan',
        'keluhan',
        'tensi_sistole',
        'tensi_diastole',
        'nadi',
        'suhu',
        'pernafasan',
        'tinggi_badan',
        'berat_badan',
        'kode_status_pulang',
        'bpjs_response',
        'bpjs_error',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kunjungan' => 'date',
            'bpjs_response' => 'array',
        ];
    }

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function mcus(): HasMany
    {
        return $this->hasMany(Mcu::class);
    }

    public function alergis(): HasMany
    {
        return $this->hasMany(Alergi::class);
    }

    public function prognosas(): HasMany
    {
        return $this->hasMany(Prognosa::class);
    }

    public function skrinnings(): HasMany
    {
        return $this->hasMany(Skrinning::class);
    }

    public function tindakans(): HasMany
    {
        return $this->hasMany(Tindakan::class);
    }

    protected static function newFactory(): KunjunganFactory
    {
        return KunjunganFactory::new();
    }
}

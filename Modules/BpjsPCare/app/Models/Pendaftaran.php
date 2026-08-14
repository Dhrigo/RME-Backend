<?php

namespace Modules\BpjsPCare\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\BpjsPCare\Database\Factories\PendaftaranFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_urut',
        'tanggal_daftar',
        'no_kartu',
        'nik',
        'nama_pasien',
        'poli_tujuan',
        'no_hp',
        'keluhan',
        'status',
        'bpjs_no_pendaftaran',
        'bpjs_response',
        'bpjs_error',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_daftar' => 'date',
            'bpjs_response' => 'array',
        ];
    }

    public function kunjungans(): HasMany
    {
        return $this->hasMany(Kunjungan::class);
    }

    protected static function newFactory(): PendaftaranFactory
    {
        return PendaftaranFactory::new();
    }
}

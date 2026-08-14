<?php

namespace Modules\BpjsPCare\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsPCare\Database\Factories\McuFactory;

class Mcu extends Model
{
    use HasFactory;

    protected $table = 'mcus';

    protected $fillable = [
        'kunjungan_id',
        'tanggal_mcu',
        'tinggi_badan',
        'berat_badan',
        'lingkar_perut',
        'tensi_sistole',
        'tensi_diastole',
        'gula_darah',
        'kolesterol',
        'asam_urat',
        'hasil_mcu',
        'rekomendasi',
        'bpjs_response',
        'bpjs_error',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mcu' => 'date',
            'bpjs_response' => 'array',
        ];
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    protected static function newFactory(): McuFactory
    {
        return McuFactory::new();
    }
}

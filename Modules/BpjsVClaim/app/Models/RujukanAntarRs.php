<?php

namespace Modules\BpjsVClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsVClaim\Database\Factories\RujukanAntarRsFactory;
use Modules\GeneralPatient\Models\Patient;

class RujukanAntarRs extends Model
{
    use HasFactory;

    protected $table = 'rujukan_antar_rs';

    protected $fillable = [
        'patient_id',
        'no_sep_asal',
        'tanggal_rencana_kunjungan',
        'jenis_pelayanan',
        'tipe_rujukan',
        'ppk_tujuan',
        'diagnosa',
        'catatan',
        'no_rujukan',
        'local_status',
        'bpjs_response',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_rencana_kunjungan' => 'date',
            'bpjs_response' => 'array',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    protected static function newFactory(): RujukanAntarRsFactory
    {
        return RujukanAntarRsFactory::new();
    }
}

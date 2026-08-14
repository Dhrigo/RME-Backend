<?php

namespace Modules\BpjsVClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsVClaim\Database\Factories\RencanaKontrolFactory;
use Modules\GeneralDoctor\Models\Doctor;

class RencanaKontrol extends Model
{
    use HasFactory;

    protected $fillable = [
        'sep_id',
        'jenis_kontrol',
        'poli_kontrol',
        'tanggal_rencana_kontrol',
        'dpjp_doctor_id',
        'no_surat_kontrol',
        'local_status',
        'bpjs_response',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_rencana_kontrol' => 'date',
            'bpjs_response' => 'array',
        ];
    }

    public function sep(): BelongsTo
    {
        return $this->belongsTo(Sep::class);
    }

    public function dpjpDoctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'dpjp_doctor_id');
    }

    protected static function newFactory(): RencanaKontrolFactory
    {
        return RencanaKontrolFactory::new();
    }
}

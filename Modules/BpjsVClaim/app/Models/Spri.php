<?php

namespace Modules\BpjsVClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsVClaim\Database\Factories\SpriFactory;
use Modules\GeneralDoctor\Models\Doctor;

class Spri extends Model
{
    use HasFactory;

    protected $fillable = [
        'sep_id',
        'tanggal_rencana_rawat_inap',
        'dpjp_doctor_id',
        'no_spri',
        'local_status',
        'bpjs_response',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_rencana_rawat_inap' => 'date',
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

    protected static function newFactory(): SpriFactory
    {
        return SpriFactory::new();
    }
}

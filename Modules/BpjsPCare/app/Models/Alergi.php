<?php

namespace Modules\BpjsPCare\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsPCare\Database\Factories\AlergiFactory;

class Alergi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kunjungan_id',
        'jenis_alergi',
        'nama_alergi',
        'reaksi',
        'tingkat_keparahan',
        'bpjs_response',
        'bpjs_error',
    ];

    protected function casts(): array
    {
        return [
            'bpjs_response' => 'array',
        ];
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    protected static function newFactory(): AlergiFactory
    {
        return AlergiFactory::new();
    }
}

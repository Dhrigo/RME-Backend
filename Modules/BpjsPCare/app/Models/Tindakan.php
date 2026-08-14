<?php

namespace Modules\BpjsPCare\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsPCare\Database\Factories\TindakanFactory;

class Tindakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kunjungan_id',
        'kode_tindakan',
        'nama_tindakan',
        'tanggal_tindakan',
        'pelaksana',
        'catatan',
        'bpjs_response',
        'bpjs_error',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_tindakan' => 'date',
            'bpjs_response' => 'array',
        ];
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    protected static function newFactory(): TindakanFactory
    {
        return TindakanFactory::new();
    }
}

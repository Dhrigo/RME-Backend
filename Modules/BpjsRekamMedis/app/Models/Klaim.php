<?php

namespace Modules\BpjsRekamMedis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\BpjsRekamMedis\Database\Factories\KlaimFactory;

class Klaim extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'no_sep',
        'jenis_pelayanan_id',
        'bulan',
        'tahun',
        'dibuat_oleh',
        'dibuat_tanggal',
        'dikirim_oleh',
        'dikirim_tanggal',
        'status',
        'bpjs_response',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'dibuat_tanggal' => 'datetime',
            'dikirim_tanggal' => 'datetime',
            'bpjs_response' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $klaim) {
            $klaim->id ??= (string) Str::uuid();
        });
    }

    protected static function newFactory(): KlaimFactory
    {
        return KlaimFactory::new();
    }
}

<?php

namespace Modules\BpjsApotek\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\BpjsApotek\Database\Factories\ApotekPelayananObatFactory;

class ApotekPelayananObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'resep_id',
        'no_sep',
        'tanggal_pelayanan',
        'bpjs_no_pelayanan',
        'status',
        'bpjs_message',
        'is_locked',
        'submitted_at',
        'deleted_at_bpjs',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pelayanan' => 'date',
            'is_locked' => 'boolean',
            'submitted_at' => 'datetime',
            'deleted_at_bpjs' => 'datetime',
        ];
    }

    public function resep(): BelongsTo
    {
        return $this->belongsTo(ApotekResep::class, 'resep_id');
    }

    public function penyimpananObats(): HasMany
    {
        return $this->hasMany(ApotekPenyimpananObat::class, 'pelayanan_id');
    }

    protected static function newFactory(): ApotekPelayananObatFactory
    {
        return ApotekPelayananObatFactory::new();
    }
}

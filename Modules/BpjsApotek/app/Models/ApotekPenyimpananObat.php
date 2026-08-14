<?php

namespace Modules\BpjsApotek\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\BpjsApotek\Database\Factories\ApotekPenyimpananObatFactory;

class ApotekPenyimpananObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelayanan_id',
        'jenis',
        'kode_obat',
        'nama_obat',
        'nama_racikan',
        'jumlah',
        'aturan_pakai',
        'signa1',
        'signa2',
        'jumlah_hari',
        'harga',
        'bpjs_no_pelayanan_obat',
        'status',
        'bpjs_message',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'decimal:2',
            'harga' => 'decimal:2',
            'submitted_at' => 'datetime',
        ];
    }

    public function pelayananObat(): BelongsTo
    {
        return $this->belongsTo(ApotekPelayananObat::class, 'pelayanan_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ApotekPenyimpananObatItem::class, 'penyimpanan_obat_id');
    }

    protected static function newFactory(): ApotekPenyimpananObatFactory
    {
        return ApotekPenyimpananObatFactory::new();
    }
}

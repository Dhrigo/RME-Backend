<?php

namespace Modules\BpjsApotek\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsApotek\Database\Factories\ApotekPenyimpananObatItemFactory;

class ApotekPenyimpananObatItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyimpanan_obat_id',
        'kode_obat',
        'nama_obat',
        'jumlah',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'decimal:2',
        ];
    }

    public function penyimpananObat(): BelongsTo
    {
        return $this->belongsTo(ApotekPenyimpananObat::class, 'penyimpanan_obat_id');
    }

    protected static function newFactory(): ApotekPenyimpananObatItemFactory
    {
        return ApotekPenyimpananObatItemFactory::new();
    }
}

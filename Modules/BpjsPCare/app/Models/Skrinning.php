<?php

namespace Modules\BpjsPCare\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsPCare\Database\Factories\SkrinningFactory;

class Skrinning extends Model
{
    use HasFactory;

    protected $fillable = [
        'kunjungan_id',
        'jenis_skrinning',
        'pertanyaan',
        'jawaban',
        'skor',
        'kesimpulan',
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

    protected static function newFactory(): SkrinningFactory
    {
        return SkrinningFactory::new();
    }
}

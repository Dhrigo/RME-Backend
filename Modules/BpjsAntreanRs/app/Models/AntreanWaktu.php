<?php

namespace Modules\BpjsAntreanRs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsAntreanRs\Database\Factories\AntreanWaktuFactory;

class AntreanWaktu extends Model
{
    use HasFactory;

    protected $table = 'antrean_rs_antrean_waktus';

    protected $fillable = [
        'antrean_id',
        'task_id',
        'waktu',
        'jenis_resep',
        'bpjs_sync_status',
        'bpjs_error',
    ];

    protected function casts(): array
    {
        return [
            'waktu' => 'datetime',
        ];
    }

    public function antrean(): BelongsTo
    {
        return $this->belongsTo(Antrean::class);
    }

    protected static function newFactory(): AntreanWaktuFactory
    {
        return AntreanWaktuFactory::new();
    }
}

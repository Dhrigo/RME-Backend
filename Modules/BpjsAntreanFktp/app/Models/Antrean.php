<?php

namespace Modules\BpjsAntreanFktp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Models\User;
use Modules\BpjsAntreanFktp\Database\Factories\AntreanFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Antrean extends Model
{
    use HasFactory;

    protected $table = 'antrean_fktp_antreans';

    protected $fillable = [
        'kodebooking',
        'visit_id',
        'jenispasien',
        'nomorkartu',
        'nik',
        'nohp',
        'kodepoli',
        'namapoli',
        'pasienbaru',
        'norm',
        'tanggalperiksa',
        'kodedokter',
        'namadokter',
        'jampraktek',
        'jeniskunjungan',
        'nomorreferensi',
        'nomorantrean',
        'angkaantrean',
        'estimasidilayani',
        'sisakuotajkn',
        'kuotajkn',
        'sisakuotanonjkn',
        'kuotanonjkn',
        'keterangan',
        'status',
        'request_payload',
        'bpjs_sync_status',
        'bpjs_error',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'pasienbaru' => 'boolean',
            'tanggalperiksa' => 'date',
            'estimasidilayani' => 'datetime',
            'request_payload' => 'array',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function waktus(): HasMany
    {
        return $this->hasMany(AntreanWaktu::class);
    }

    protected static function newFactory(): AntreanFactory
    {
        return AntreanFactory::new();
    }
}

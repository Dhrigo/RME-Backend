<?php

namespace Modules\BpjsApotek\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Models\User;
use Modules\BpjsApotek\Database\Factories\ApotekResepFactory;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PendaftaranVisit\Models\Visit;

class ApotekResep extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'prescription_id',
        'no_sep',
        'no_kartu',
        'tanggal_resep',
        'tanggal_input',
        'poli_kode',
        'request_payload',
        'bpjs_no_resep',
        'status',
        'bpjs_message',
        'submitted_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_resep' => 'date',
            'tanggal_input' => 'date',
            'request_payload' => 'array',
            'submitted_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pelayananObats(): HasMany
    {
        return $this->hasMany(ApotekPelayananObat::class, 'resep_id');
    }

    protected static function newFactory(): ApotekResepFactory
    {
        return ApotekResepFactory::new();
    }
}

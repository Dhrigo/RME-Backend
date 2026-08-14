<?php

namespace Modules\BpjsVClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\BpjsVClaim\Database\Factories\SepPengajuanFactory;

class SepPengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'sep_id',
        'jenis',
        'alasan',
        'status',
        'approved_by',
        'approved_at',
        'bpjs_response',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'bpjs_response' => 'array',
        ];
    }

    public function sep(): BelongsTo
    {
        return $this->belongsTo(Sep::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    protected static function newFactory(): SepPengajuanFactory
    {
        return SepPengajuanFactory::new();
    }
}

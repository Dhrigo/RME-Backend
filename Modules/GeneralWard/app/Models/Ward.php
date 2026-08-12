<?php

namespace Modules\GeneralWard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Database\Factories\WardFactory;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id',
        'visit_type_id',
        'allows_request',
        'created_by',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'allows_request' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): WardFactory
    {
        return WardFactory::new();
    }
}

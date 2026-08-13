<?php

namespace Modules\GeneralReferenceMap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Modules\GeneralReferenceMap\Database\Factories\ReferenceMapFactory;

class ReferenceMap extends Model
{
    use HasFactory;

    protected $table = 'reference_maps';

    protected $fillable = [
        'source_system',
        'source_code',
        'target_category',
        'target_code',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): ReferenceMapFactory
    {
        return ReferenceMapFactory::new();
    }
}

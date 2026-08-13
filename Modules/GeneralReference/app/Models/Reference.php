<?php

namespace Modules\GeneralReference\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Modules\GeneralReference\Database\Factories\ReferenceFactory;

class Reference extends Model
{
    use HasFactory;

    protected $table = 'reference_entries';

    protected $fillable = [
        'category',
        'code',
        'name',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): ReferenceFactory
    {
        return ReferenceFactory::new();
    }
}

<?php

namespace Modules\GeneralBirthplace\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Modules\GeneralBirthplace\Database\Factories\BirthplaceFactory;

class Birthplace extends Model
{
    use HasFactory;

    protected $table = 'birthplaces';

    protected $fillable = [
        'name',
        'village_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): BirthplaceFactory
    {
        return BirthplaceFactory::new();
    }
}

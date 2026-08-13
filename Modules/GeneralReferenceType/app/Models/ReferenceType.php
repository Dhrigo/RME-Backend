<?php

namespace Modules\GeneralReferenceType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralReferenceType\Database\Factories\ReferenceTypeFactory;

class ReferenceType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation', 'is_application', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_application' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): ReferenceTypeFactory
    {
        return ReferenceTypeFactory::new();
    }
}

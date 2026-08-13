<?php

namespace Modules\MedicalRecordImplementationChecklistItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordImplementationChecklistItem\Database\Factories\ImplementationChecklistItemFactory;

class ImplementationChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): ImplementationChecklistItemFactory
    {
        return ImplementationChecklistItemFactory::new();
    }
}

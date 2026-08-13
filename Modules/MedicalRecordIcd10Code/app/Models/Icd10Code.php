<?php

namespace Modules\MedicalRecordIcd10Code\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordIcd10Code\Database\Factories\Icd10CodeFactory;

class Icd10Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'category',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): Icd10CodeFactory
    {
        return Icd10CodeFactory::new();
    }
}

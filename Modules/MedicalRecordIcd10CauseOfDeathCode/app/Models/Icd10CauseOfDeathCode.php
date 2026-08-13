<?php

namespace Modules\MedicalRecordIcd10CauseOfDeathCode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordIcd10CauseOfDeathCode\Database\Factories\Icd10CauseOfDeathCodeFactory;

class Icd10CauseOfDeathCode extends Model
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

    protected static function newFactory(): Icd10CauseOfDeathCodeFactory
    {
        return Icd10CauseOfDeathCodeFactory::new();
    }
}

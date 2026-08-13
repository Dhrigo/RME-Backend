<?php

namespace Modules\MedicalRecordIcd9CmCode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordIcd9CmCode\Database\Factories\Icd9CmCodeFactory;

class Icd9CmCode extends Model
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

    protected static function newFactory(): Icd9CmCodeFactory
    {
        return Icd9CmCodeFactory::new();
    }
}

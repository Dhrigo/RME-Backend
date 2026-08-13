<?php

namespace Modules\MedicalRecordNursingIndicatorType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordNursingIndicatorType\Database\Factories\NursingIndicatorTypeFactory;

class NursingIndicatorType extends Model
{
    use HasFactory;

    protected $fillable = [
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

    protected static function newFactory(): NursingIndicatorTypeFactory
    {
        return NursingIndicatorTypeFactory::new();
    }
}

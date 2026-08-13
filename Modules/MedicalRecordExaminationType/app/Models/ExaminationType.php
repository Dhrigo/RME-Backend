<?php

namespace Modules\MedicalRecordExaminationType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordExaminationType\Database\Factories\ExaminationTypeFactory;

class ExaminationType extends Model
{
    use HasFactory;

    protected $fillable = [
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

    protected static function newFactory(): ExaminationTypeFactory
    {
        return ExaminationTypeFactory::new();
    }
}

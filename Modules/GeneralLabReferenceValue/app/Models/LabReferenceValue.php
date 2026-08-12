<?php

namespace Modules\GeneralLabReferenceValue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralLabReferenceValue\Database\Factories\LabReferenceValueFactory;
use Modules\GeneralLabServiceParameter\Models\LabServiceParameter;

class LabReferenceValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_service_parameter_id',
        'gender',
        'min_age',
        'max_age',
        'min_value',
        'max_value',
        'unit',
        'note',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'min_value' => 'decimal:2',
            'max_value' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function labServiceParameter()
    {
        return $this->belongsTo(LabServiceParameter::class);
    }

    protected static function newFactory(): LabReferenceValueFactory
    {
        return LabReferenceValueFactory::new();
    }
}

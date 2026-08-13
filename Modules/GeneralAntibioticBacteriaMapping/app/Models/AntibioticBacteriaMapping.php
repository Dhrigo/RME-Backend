<?php

namespace Modules\GeneralAntibioticBacteriaMapping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralAntibioticBacteriaMapping\Database\Factories\AntibioticBacteriaMappingFactory;

class AntibioticBacteriaMapping extends Model
{
    use HasFactory;

    public const SENSITIVITY_CATEGORIES = ['S', 'I', 'R'];

    protected $fillable = [
        'antibiotic_name',
        'bacteria_name',
        'sensitivity_category',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): AntibioticBacteriaMappingFactory
    {
        return AntibioticBacteriaMappingFactory::new();
    }
}

<?php

namespace Modules\GeneralIcdSnomedCtMapping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralIcdSnomedCtMapping\Database\Factories\IcdSnomedCtMappingFactory;

class IcdSnomedCtMapping extends Model
{
    use HasFactory;

    protected $fillable = ['icd_code', 'snomed_code', 'icd_description', 'snomed_description', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): IcdSnomedCtMappingFactory
    {
        return IcdSnomedCtMappingFactory::new();
    }
}

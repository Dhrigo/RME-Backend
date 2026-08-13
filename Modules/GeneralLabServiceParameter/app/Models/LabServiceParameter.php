<?php

namespace Modules\GeneralLabServiceParameter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralLabServiceGroup\Models\LabServiceGroup;
use Modules\GeneralLabServiceParameter\Database\Factories\LabServiceParameterFactory;

class LabServiceParameter extends Model
{
    use HasFactory;

    protected $fillable = ['lab_service_group_id', 'name', 'code', 'unit', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function labServiceGroup()
    {
        return $this->belongsTo(LabServiceGroup::class);
    }

    protected static function newFactory(): LabServiceParameterFactory
    {
        return LabServiceParameterFactory::new();
    }
}

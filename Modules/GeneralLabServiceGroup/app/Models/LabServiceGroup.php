<?php

namespace Modules\GeneralLabServiceGroup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralLabServiceGroup\Database\Factories\LabServiceGroupFactory;

class LabServiceGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): LabServiceGroupFactory
    {
        return LabServiceGroupFactory::new();
    }
}

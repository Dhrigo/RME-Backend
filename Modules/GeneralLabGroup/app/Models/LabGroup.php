<?php

namespace Modules\GeneralLabGroup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralLabGroup\Database\Factories\LabGroupFactory;

class LabGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): LabGroupFactory
    {
        return LabGroupFactory::new();
    }
}

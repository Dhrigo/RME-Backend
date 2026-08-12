<?php

namespace Modules\GeneralOccupation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralOccupation\Database\Factories\OccupationFactory;

class Occupation extends Model
{
    use HasFactory;

    protected $table = 'occupations';

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): OccupationFactory
    {
        return OccupationFactory::new();
    }
}

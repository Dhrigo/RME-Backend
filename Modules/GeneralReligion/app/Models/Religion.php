<?php

namespace Modules\GeneralReligion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralReligion\Database\Factories\ReligionFactory;

class Religion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): ReligionFactory
    {
        return ReligionFactory::new();
    }
}

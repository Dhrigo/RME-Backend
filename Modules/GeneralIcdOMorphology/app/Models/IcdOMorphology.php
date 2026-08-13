<?php

namespace Modules\GeneralIcdOMorphology\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralIcdOMorphology\Database\Factories\IcdOMorphologyFactory;

class IcdOMorphology extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): IcdOMorphologyFactory
    {
        return IcdOMorphologyFactory::new();
    }
}

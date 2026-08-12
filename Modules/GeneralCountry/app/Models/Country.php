<?php

namespace Modules\GeneralCountry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralCountry\Database\Factories\CountryFactory;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }
}

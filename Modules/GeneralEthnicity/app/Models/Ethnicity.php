<?php

namespace Modules\GeneralEthnicity\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralEthnicity\Database\Factories\EthnicityFactory;

class Ethnicity extends Model
{
    use HasFactory;

    protected $table = 'ethnicities';

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): EthnicityFactory
    {
        return EthnicityFactory::new();
    }
}

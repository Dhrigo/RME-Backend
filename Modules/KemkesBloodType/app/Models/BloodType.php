<?php

namespace Modules\KemkesBloodType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\KemkesBloodType\Database\Factories\BloodTypeFactory;

class BloodType extends Model
{
    use HasFactory;

    protected $table = 'blood_types';

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): BloodTypeFactory
    {
        return BloodTypeFactory::new();
    }
}

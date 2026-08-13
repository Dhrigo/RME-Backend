<?php

namespace Modules\PenjaminRSDischargeMethod\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PenjaminRSDischargeMethod\Database\Factories\DischargeMethodFactory;

class DischargeMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): DischargeMethodFactory
    {
        return DischargeMethodFactory::new();
    }
}
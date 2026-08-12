<?php

namespace Modules\GeneralMaritalStatus\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralMaritalStatus\Database\Factories\MaritalStatusFactory;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $table = 'marital_statuses';

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): MaritalStatusFactory
    {
        return MaritalStatusFactory::new();
    }
}

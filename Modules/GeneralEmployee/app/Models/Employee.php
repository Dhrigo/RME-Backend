<?php

namespace Modules\GeneralEmployee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Database\Factories\EmployeeFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_number',
        'name',
        'nickname',
        'title_prefix',
        'title_suffix',
        'birth_place',
        'birth_date',
        'religion_id',
        'gender_id',
        'profession_id',
        'smf_id',
        'address',
        'rt',
        'rw',
        'postal_code',
        'region_code',
        'is_non_employee',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_non_employee' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory(): EmployeeFactory
    {
        return EmployeeFactory::new();
    }
}

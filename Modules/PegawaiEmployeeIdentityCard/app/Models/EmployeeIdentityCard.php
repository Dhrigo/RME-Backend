<?php

namespace Modules\PegawaiEmployeeIdentityCard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiEmployeeIdentityCard\Database\Factories\EmployeeIdentityCardFactory;

class EmployeeIdentityCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'id_type',
        'id_number',
        'issued_at',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory(): EmployeeIdentityCardFactory
    {
        return EmployeeIdentityCardFactory::new();
    }
}

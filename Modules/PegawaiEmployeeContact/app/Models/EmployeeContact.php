<?php

namespace Modules\PegawaiEmployeeContact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiEmployeeContact\Database\Factories\EmployeeContactFactory;

class EmployeeContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'contact_type',
        'value',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory(): EmployeeContactFactory
    {
        return EmployeeContactFactory::new();
    }
}

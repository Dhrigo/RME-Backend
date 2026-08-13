<?php

namespace Modules\PegawaiPracticeLicense\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiPracticeLicense\Database\Factories\PracticeLicenseFactory;

class PracticeLicense extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'license_type',
        'license_number',
        'issued_at',
        'expires_at',
        'issuing_authority',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
            'expires_at' => 'date',
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory(): PracticeLicenseFactory
    {
        return PracticeLicenseFactory::new();
    }
}

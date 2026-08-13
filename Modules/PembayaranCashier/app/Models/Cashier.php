<?php

namespace Modules\PembayaranCashier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranCashier\Database\Factories\CashierFactory;

class Cashier extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'cashier_code',
        'shift',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory(): CashierFactory
    {
        return CashierFactory::new();
    }
}

<?php

namespace Modules\PembayaranDoctorDiscount\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranDiscount\Models\Discount;
use Modules\PembayaranDoctorDiscount\Database\Factories\DoctorDiscountFactory;

class DoctorDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id',
        'employee_id',
        'percentage',
    ];

    protected function casts(): array
    {
        return ['percentage' => 'decimal:2'];
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory(): DoctorDiscountFactory
    {
        return DoctorDiscountFactory::new();
    }
}

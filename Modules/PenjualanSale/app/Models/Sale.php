<?php

namespace Modules\PenjualanSale\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PenjualanSale\Database\Factories\SaleFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_number',
        'patient_id',
        'sold_by',
        'sold_at',
        'total_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'sold_at' => 'datetime',
            'total_amount' => 'decimal:2',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function soldBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'sold_by');
    }

    /**
     * Format: SAL-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateSaleNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('sale_number', 'like', "SAL-{$year}-%")->count();

        return sprintf('SAL-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): SaleFactory
    {
        return SaleFactory::new();
    }
}

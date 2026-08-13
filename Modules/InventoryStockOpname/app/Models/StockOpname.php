<?php

namespace Modules\InventoryStockOpname\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryStockOpname\Database\Factories\StockOpnameFactory;

class StockOpname extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'opname_date',
        'conducted_by',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'opname_date' => 'date',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function conductedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'conducted_by');
    }

    protected static function newFactory(): StockOpnameFactory
    {
        return StockOpnameFactory::new();
    }
}

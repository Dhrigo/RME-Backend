<?php

namespace Modules\GeneralSalesTax\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralSalesTax\Database\Factories\SalesTaxFactory;

class SalesTax extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rate', 'effective_date', 'is_active'];

    protected function casts(): array
    {
        return [
            'rate' => 'decimal:2',
            'effective_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): SalesTaxFactory
    {
        return SalesTaxFactory::new();
    }
}

<?php

namespace Modules\PembayaranPackageInvoiceItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPackage\Models\Package;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPackageInvoiceItem\Database\Factories\PackageInvoiceItemFactory;

class PackageInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'package_id',
        'quantity',
        'unit_price',
        'subtotal',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (PackageInvoiceItem $item) {
            $item->subtotal = $item->quantity * $item->unit_price;
        });
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    protected static function newFactory(): PackageInvoiceItemFactory
    {
        return PackageInvoiceItemFactory::new();
    }
}

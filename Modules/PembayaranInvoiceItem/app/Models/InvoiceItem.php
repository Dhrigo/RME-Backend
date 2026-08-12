<?php

namespace Modules\PembayaranInvoiceItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceItem\Database\Factories\InvoiceItemFactory;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'description',
        'category',
        'quantity',
        'unit_price',
        'subtotal',
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
        static::saving(function (InvoiceItem $item) {
            $item->subtotal = $item->quantity * $item->unit_price;
        });
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function newFactory(): InvoiceItemFactory
    {
        return InvoiceItemFactory::new();
    }
}

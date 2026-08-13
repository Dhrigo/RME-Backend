<?php

namespace Modules\PembayaranInvoiceCancellation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceCancellation\Database\Factories\InvoiceCancellationFactory;

class InvoiceCancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'cancelled_at',
        'cancelled_by',
        'reason',
    ];

    protected function casts(): array
    {
        return ['cancelled_at' => 'datetime'];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    protected static function newFactory(): InvoiceCancellationFactory
    {
        return InvoiceCancellationFactory::new();
    }
}

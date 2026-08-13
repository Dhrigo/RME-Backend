<?php

namespace Modules\PembayaranCorporateReceivable\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PembayaranCorporateReceivable\Database\Factories\CorporateReceivableFactory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class CorporateReceivable extends Model
{
    use HasFactory;

    public const STATUSES = ['outstanding', 'settled', 'written_off'];

    protected $fillable = [
        'invoice_id',
        'guarantor_id',
        'amount',
        'due_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'due_date' => 'date',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function guarantor(): BelongsTo
    {
        return $this->belongsTo(Guarantor::class);
    }

    protected static function newFactory(): CorporateReceivableFactory
    {
        return CorporateReceivableFactory::new();
    }
}

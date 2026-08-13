<?php

namespace Modules\PembayaranRegistrationInvoice\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranRegistrationInvoice\Database\Factories\RegistrationInvoiceFactory;
use Modules\PendaftaranRegistration\Models\Registration;

class RegistrationInvoice extends Model
{
    use HasFactory;

    public const CATEGORIES = ['registration_fee', 'admission_deposit'];

    protected $fillable = [
        'registration_id',
        'invoice_id',
        'invoice_category',
        'amount',
        'notes',
    ];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2'];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function newFactory(): RegistrationInvoiceFactory
    {
        return RegistrationInvoiceFactory::new();
    }
}

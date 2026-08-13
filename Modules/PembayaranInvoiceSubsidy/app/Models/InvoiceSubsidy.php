<?php

namespace Modules\PembayaranInvoiceSubsidy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceSubsidy\Database\Factories\InvoiceSubsidyFactory;

class InvoiceSubsidy extends Model
{
    use HasFactory;

    public const SUBSIDY_SOURCES = ['pemerintah_daerah', 'yayasan', 'csr_perusahaan', 'bantuan_sosial'];

    public const STATUSES = ['pending', 'approved', 'rejected'];

    protected $fillable = [
        'invoice_id',
        'subsidy_source',
        'subsidy_amount',
        'approved_by',
        'approved_at',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'subsidy_amount' => 'decimal:2',
            'approved_at' => 'datetime',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    protected static function newFactory(): InvoiceSubsidyFactory
    {
        return InvoiceSubsidyFactory::new();
    }
}

<?php

namespace Modules\PembayaranProviderService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PembayaranPaymentProvider\Models\PaymentProvider;
use Modules\PembayaranProviderService\Database\Factories\ProviderServiceFactory;

class ProviderService extends Model
{
    use HasFactory;

    public const SERVICE_TYPES = ['va_transfer', 'qris', 'credit_card', 'e_wallet'];

    public const ADMIN_FEE_TYPES = ['flat', 'percentage'];

    protected $fillable = [
        'payment_provider_id',
        'service_code',
        'service_name',
        'service_type',
        'admin_fee_type',
        'admin_fee_amount',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'admin_fee_amount' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function paymentProvider(): BelongsTo
    {
        return $this->belongsTo(PaymentProvider::class);
    }

    protected static function newFactory(): ProviderServiceFactory
    {
        return ProviderServiceFactory::new();
    }
}

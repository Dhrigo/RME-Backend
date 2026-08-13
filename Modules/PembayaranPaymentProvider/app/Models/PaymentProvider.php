<?php

namespace Modules\PembayaranPaymentProvider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PembayaranPaymentProvider\Database\Factories\PaymentProviderFactory;

class PaymentProvider extends Model
{
    use HasFactory;

    public const PROVIDER_TYPES = ['bank', 'e_wallet', 'aggregator', 'credit_card'];

    protected $fillable = [
        'provider_code',
        'provider_name',
        'provider_type',
        'merchant_id',
        'api_base_url',
        'contact_person',
        'contact_phone',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): PaymentProviderFactory
    {
        return PaymentProviderFactory::new();
    }
}

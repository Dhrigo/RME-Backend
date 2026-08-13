<?php

namespace Modules\GeneralGuarantorParticipantType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralGuarantorParticipantType\Database\Factories\GuarantorParticipantTypeFactory;

class GuarantorParticipantType extends Model
{
    use HasFactory;

    public const PAYER_TYPES = ['self_pay', 'bpjs', 'insurance', 'corporate'];

    protected $fillable = [
        'name',
        'code',
        'payer_type',
        'requires_verification',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'requires_verification' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): GuarantorParticipantTypeFactory
    {
        return GuarantorParticipantTypeFactory::new();
    }
}

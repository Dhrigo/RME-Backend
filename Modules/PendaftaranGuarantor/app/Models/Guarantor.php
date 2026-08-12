<?php

namespace Modules\PendaftaranGuarantor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralRoomClass\Models\RoomClass;
use Modules\PendaftaranGuarantor\Database\Factories\GuarantorFactory;
use Modules\PendaftaranRegistration\Models\Registration;

class Guarantor extends Model
{
    use HasFactory;

    public const PAYER_TYPES = ['self_pay', 'bpjs', 'insurance', 'corporate'];

    protected $fillable = [
        'registration_id',
        'payer_type',
        'member_number',
        'room_class_id',
        'reference_letter_number',
        'notes',
        'created_by',
        'status',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function roomClass(): BelongsTo
    {
        return $this->belongsTo(RoomClass::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): GuarantorFactory
    {
        return GuarantorFactory::new();
    }
}

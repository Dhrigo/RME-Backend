<?php

namespace Modules\GeneralAudioAttachment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\Auth\Models\User;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralAudioAttachment\Database\Factories\AudioAttachmentFactory;

class AudioAttachment extends Model
{
    use HasFactory;

    protected $table = 'audio_attachments';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'title',
        'file_path',
        'mime_type',
        'duration_seconds',
        'recorded_by',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    protected static function newFactory(): AudioAttachmentFactory
    {
        return AudioAttachmentFactory::new();
    }
}

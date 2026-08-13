<?php

namespace Modules\LayananPharmacyOutpatientQueue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPharmacyOutpatientQueue\Database\Factories\PharmacyOutpatientQueueFactory;

class PharmacyOutpatientQueue extends Model
{
    use HasFactory;

    protected $table = 'pharmacy_outpatient_queues';

    public const STATUSS = ['waiting', 'called', 'done'];

    protected $fillable = [
        'prescription_id',
        'queue_number',
        'status',
        'called_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'called_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    protected static function newFactory(): PharmacyOutpatientQueueFactory
    {
        return PharmacyOutpatientQueueFactory::new();
    }
}

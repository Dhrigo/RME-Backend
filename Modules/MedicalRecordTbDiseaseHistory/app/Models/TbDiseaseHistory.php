<?php

namespace Modules\MedicalRecordTbDiseaseHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordTbDiseaseHistory\Database\Factories\TbDiseaseHistoryFactory;

class TbDiseaseHistory extends Model
{
    use HasFactory;

    protected $table = 'tb_disease_histories';

    protected $fillable = [
        'visit_id',
        'created_by',
        'previous_tb_treatment',
        'treatment_year',
        'treatment_outcome',
        'tb_category',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'previous_tb_treatment' => 'boolean',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): TbDiseaseHistoryFactory
    {
        return TbDiseaseHistoryFactory::new();
    }
}

<?php

namespace Modules\LayananAntimicrobialStewardshipGeneralExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Modules\LayananAntimicrobialStewardshipGeneralExamination\Database\Factories\AntimicrobialStewardshipGeneralExaminationFactory;

class AntimicrobialStewardshipGeneralExamination extends Model
{
    use HasFactory;

    protected $table = 'antimicrobial_stewardship_general_examinations';

    protected $fillable = [
        'antimicrobial_stewardship_form_id',
        'temperature',
        'pulse',
        'respiration_rate',
        'blood_pressure',
        'weight_kg',
        'height_cm',
        'examined_at',
    ];

    protected function casts(): array
    {
        return [
            'temperature' => 'decimal:1',
            'weight_kg' => 'decimal:2',
            'height_cm' => 'decimal:2',
            'examined_at' => 'datetime',
        ];
    }

    public function antimicrobialStewardshipForm(): BelongsTo
    {
        return $this->belongsTo(AntimicrobialStewardshipForm::class, 'antimicrobial_stewardship_form_id');
    }

    protected static function newFactory(): AntimicrobialStewardshipGeneralExaminationFactory
    {
        return AntimicrobialStewardshipGeneralExaminationFactory::new();
    }
}

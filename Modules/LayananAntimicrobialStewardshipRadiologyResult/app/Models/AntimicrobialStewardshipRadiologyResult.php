<?php

namespace Modules\LayananAntimicrobialStewardshipRadiologyResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Modules\LayananAntimicrobialStewardshipRadiologyResult\Database\Factories\AntimicrobialStewardshipRadiologyResultFactory;

class AntimicrobialStewardshipRadiologyResult extends Model
{
    use HasFactory;

    protected $table = 'antimicrobial_stewardship_radiology_results';

    protected $fillable = [
        'antimicrobial_stewardship_form_id',
        'examination_name',
        'findings',
        'examined_at',
    ];

    protected function casts(): array
    {
        return [
            'examined_at' => 'datetime',
        ];
    }

    public function antimicrobialStewardshipForm(): BelongsTo
    {
        return $this->belongsTo(AntimicrobialStewardshipForm::class, 'antimicrobial_stewardship_form_id');
    }

    protected static function newFactory(): AntimicrobialStewardshipRadiologyResultFactory
    {
        return AntimicrobialStewardshipRadiologyResultFactory::new();
    }
}

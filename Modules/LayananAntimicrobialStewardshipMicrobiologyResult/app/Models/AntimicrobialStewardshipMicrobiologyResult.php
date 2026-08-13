<?php

namespace Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Database\Factories\AntimicrobialStewardshipMicrobiologyResultFactory;

class AntimicrobialStewardshipMicrobiologyResult extends Model
{
    use HasFactory;

    protected $table = 'antimicrobial_stewardship_microbiology_results';

    protected $fillable = [
        'antimicrobial_stewardship_form_id',
        'specimen_type',
        'organism_found',
        'sensitivity_result',
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

    protected static function newFactory(): AntimicrobialStewardshipMicrobiologyResultFactory
    {
        return AntimicrobialStewardshipMicrobiologyResultFactory::new();
    }
}

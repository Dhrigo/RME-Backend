<?php

namespace Modules\LayananAntimicrobialStewardshipPriorHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Modules\LayananAntimicrobialStewardshipPriorHistory\Database\Factories\AntimicrobialStewardshipPriorHistoryFactory;

class AntimicrobialStewardshipPriorHistory extends Model
{
    use HasFactory;

    protected $table = 'antimicrobial_stewardship_prior_histories';

    protected $fillable = [
        'antimicrobial_stewardship_form_id',
        'previous_antibiotic',
        'start_date',
        'end_date',
        'outcome',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function antimicrobialStewardshipForm(): BelongsTo
    {
        return $this->belongsTo(AntimicrobialStewardshipForm::class, 'antimicrobial_stewardship_form_id');
    }

    protected static function newFactory(): AntimicrobialStewardshipPriorHistoryFactory
    {
        return AntimicrobialStewardshipPriorHistoryFactory::new();
    }
}

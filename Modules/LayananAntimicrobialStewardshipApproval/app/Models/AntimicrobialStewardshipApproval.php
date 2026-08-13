<?php

namespace Modules\LayananAntimicrobialStewardshipApproval\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Modules\LayananAntimicrobialStewardshipApproval\Database\Factories\AntimicrobialStewardshipApprovalFactory;

class AntimicrobialStewardshipApproval extends Model
{
    use HasFactory;

    protected $table = 'antimicrobial_stewardship_approvals';

    public const DECISIONS = ['approved', 'rejected'];

    protected $fillable = [
        'antimicrobial_stewardship_form_id',
        'approved_by',
        'decision',
        'decision_note',
        'decided_at',
    ];

    protected function casts(): array
    {
        return [
            'decided_at' => 'datetime',
        ];
    }

    public function antimicrobialStewardshipForm(): BelongsTo
    {
        return $this->belongsTo(AntimicrobialStewardshipForm::class, 'antimicrobial_stewardship_form_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

    protected static function newFactory(): AntimicrobialStewardshipApprovalFactory
    {
        return AntimicrobialStewardshipApprovalFactory::new();
    }
}

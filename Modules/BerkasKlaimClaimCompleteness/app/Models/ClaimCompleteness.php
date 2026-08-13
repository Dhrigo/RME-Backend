<?php

namespace Modules\BerkasKlaimClaimCompleteness\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaimCompleteness extends Model
{
    use HasFactory;

    protected $table = 'claim_completeness';

    protected $fillable = ['claim_file_id', 'checklist_item', 'is_complete', 'checked_by', 'checked_at'];

    protected $casts = [
        'is_complete' => 'boolean',
        'checked_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Modules\BerkasKlaimClaimCompleteness\Database\Factories\ClaimCompletenessFactory::new();
    }
}

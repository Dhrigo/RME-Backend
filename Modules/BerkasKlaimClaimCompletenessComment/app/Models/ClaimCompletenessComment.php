<?php

namespace Modules\BerkasKlaimClaimCompletenessComment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaimCompletenessComment extends Model
{
    use HasFactory;

    protected $fillable = ['claim_completeness_id', 'comment', 'commented_by', 'commented_at'];

    protected $casts = [
        'commented_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Modules\BerkasKlaimClaimCompletenessComment\Database\Factories\ClaimCompletenessCommentFactory::new();
    }
}

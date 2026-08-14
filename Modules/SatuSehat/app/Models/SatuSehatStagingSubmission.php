<?php

namespace Modules\SatuSehat\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SatuSehat\Database\Factories\SatuSehatStagingSubmissionFactory;

class SatuSehatStagingSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_type',
        'satusehat_id',
        'source_type',
        'source_id',
        'payload',
        'status',
        'attempts',
        'last_error',
        'sent_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'sent_at' => 'datetime',
    ];

    protected static function newFactory(): SatuSehatStagingSubmissionFactory
    {
        return SatuSehatStagingSubmissionFactory::new();
    }
}

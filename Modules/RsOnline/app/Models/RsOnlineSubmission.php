<?php

namespace Modules\RsOnline\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\RsOnline\Database\Factories\RsOnlineSubmissionFactory;

/**
 * Local ledger of push/write traffic to RS Online (SumberDaya-v1 DataSDM/
 * DataLayanan/AlkesData/DataTempatTidur, RsOnline-v1 RegistrasiUser).
 * Body schemas for these Apigility resources were not published in the live
 * documentation panel (kemkes_research_findings_part2.md notes several
 * panels "display empty body schemas") - payload/response kept as raw JSON
 * rather than invented columns.
 */
class RsOnlineSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource',
        'payload',
        'response',
        'status',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'response' => 'array',
        ];
    }

    protected static function newFactory(): RsOnlineSubmissionFactory
    {
        return RsOnlineSubmissionFactory::new();
    }
}

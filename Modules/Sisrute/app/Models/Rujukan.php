<?php

namespace Modules\Sisrute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisrute\Database\Factories\RujukanFactory;

/**
 * Local ledger of Rujukan (patient referral) traffic through SISRUTE - both
 * outbound (this hospital refers a patient out) and inbound (this hospital
 * receives/answers a referral). SISRUTE's Rujukan-v1 Apigility resource body
 * schemas were not published in the live documentation panel (only the
 * resource list was confirmed: Rujukan/NotifRujukan/JawabRujukan/
 * BatalRujukan/ImagesRujukan/PasienRujukan) - payload/response are kept as
 * raw JSON rather than decomposed into invented columns.
 */
class Rujukan extends Model
{
    use HasFactory;

    protected $fillable = [
        'direction',
        'action',
        'no_rujukan',
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

    protected static function newFactory(): RujukanFactory
    {
        return RujukanFactory::new();
    }
}

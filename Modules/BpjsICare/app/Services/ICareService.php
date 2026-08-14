<?php

namespace Modules\BpjsICare\Services;

use Modules\Bpjs\Services\BpjsClient;

/**
 * i-Care proper (distinct from WS Rekam Medis / SmartClaim) - LZString crypto scheme like
 * VClaim, base URL `ihs_dev`. Targets the FKRTL (hospital) signature variant - same HMAC
 * formula BpjsSignature already implements; BPJS's portal documents a separate FKTP variant
 * for clinics, not used by this hospital-side integration.
 */
class ICareService
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    /**
     * "API Data Riwayat Pelayanan" - looks up a patient's cross-facility care history.
     *
     * @param  string  $param  BPJS card number
     * @param  int|string  $kodeDokter  doctor code
     */
    public function validate(string $param, int|string $kodeDokter): object
    {
        return $this->client->call('icare', 'POST', 'api/rs/validate', [
            'param' => $param,
            'kodedokter' => $kodeDokter,
        ], encrypted: true);
    }
}

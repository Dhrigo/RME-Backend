<?php

namespace Modules\BpjsRekamMedis\Services;

use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRBundle;
use Illuminate\Support\Facades\Http;
use Modules\Bpjs\Services\BpjsCrypto;
use Modules\Bpjs\Services\BpjsSignature;

/**
 * Sends the "rekammedis/insert" request. Ported from BPJS\SmartClaim\V1\Rpc\Klaim\
 * KlaimController::kirimAction() in the original ZF2 source.
 *
 * Credential/URL split (judgment call, see module report): the original source signs and
 * derives the crypto key from its own `smartclaim` config block, and posts to
 * `$this->config['url']` from that SAME block. Our kernel splits `smartclaim` and
 * `rekam_medis` into two distinct family configs (BPJS's Base URL catalog lists eRekamMedis
 * as its own service). We sign + derive the AES key from `smartclaim` (matching the original
 * source's credential source) but POST to the `rekam_medis` family's base_url (matching BPJS's
 * own service catalog naming for this endpoint) - if this pairing turns out wrong once real
 * credentials are available, only the two `config('bpjs.families.*.base_url')` values need
 * fixing, not this class.
 *
 * Uses BpjsCrypto::encryptGzip() directly (not BpjsClient::call(), which only handles the
 * LZString scheme) - BpjsCrypto::encryptGzip() already performs gzcompress+base64+AES-encrypt
 * (returning base64 ciphertext) in one call, matching the original source's
 * gzcompress->base64_encode->encrypt() chain. We then base64_encode the result ONE more time,
 * matching the original's extra `$dataMR = base64_encode($dataMR);` after encrypt().
 */
class RekamMedisService
{
    public function __construct(
        private readonly BpjsSignature $signature,
        private readonly BpjsCrypto $crypto,
    ) {
    }

    public function submit(FHIRBundle $bundle, string $noSep, string $jenisPelayanan, string $bulan, string $tahun): object
    {
        $smartclaim = config('bpjs.families.smartclaim');
        $rekamMedis = config('bpjs.families.rekam_medis');
        $kodeBpjs = config('bpjs.koders');

        $dataMR = base64_encode($this->crypto->encryptGzip(
            json_encode($bundle),
            $smartclaim['cons_id'],
            $smartclaim['secret_key'],
            $kodeBpjs,
        ));

        $headers = $this->signature->headers($smartclaim, config('bpjs.timezone'), config('bpjs.signature_add_time'));

        $response = Http::withHeaders($headers)
            ->withOptions(['verify' => app()->environment('production')])
            ->post(rtrim($rekamMedis['base_url'], '/').'/rekammedis/insert', [
                'request' => [
                    'noSep' => $noSep,
                    'jenisPelayanan' => $jenisPelayanan,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'dataMR' => $dataMR,
                ],
            ]);

        return json_decode($response->body());
    }
}

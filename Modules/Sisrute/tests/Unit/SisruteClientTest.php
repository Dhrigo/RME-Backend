<?php

namespace Modules\Sisrute\Tests\Unit;

use Illuminate\Support\Facades\Http;
use Modules\Sisrute\Services\SisruteClient;
use Tests\TestCase;

class SisruteClientTest extends TestCase
{
    public function test_it_signs_requests_with_hmac_headers(): void
    {
        config([
            'sisrute.cons_id' => '1000',
            'sisrute.password' => 'secret',
        ]);

        Http::fake(['*' => Http::response(['status' => 'ok'])]);

        (new SisruteClient())->call('GET', 'rujukan/rujukan');

        Http::assertSent(function ($request) {
            return $request->hasHeader('X-cons-id', '1000')
                && $request->hasHeader('X-Timestamp')
                && $request->hasHeader('X-signature');
        });
    }
}

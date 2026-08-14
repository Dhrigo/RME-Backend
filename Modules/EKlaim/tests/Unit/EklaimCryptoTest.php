<?php

namespace Modules\EKlaim\Tests\Unit;

use Modules\EKlaim\Services\EklaimCrypto;
use Tests\TestCase;

class EklaimCryptoTest extends TestCase
{
    private function key(): string
    {
        return bin2hex(random_bytes(32));
    }

    public function test_it_round_trips_encrypt_and_decrypt(): void
    {
        $crypto = new EklaimCrypto();
        $key = $this->key();

        $wire = $crypto->encrypt('{"hello":"world"}', $key);
        $plain = $crypto->decrypt($wire, $key);

        $this->assertSame('{"hello":"world"}', $plain);
    }

    public function test_it_detects_a_tampered_signature(): void
    {
        $crypto = new EklaimCrypto();
        $key = $this->key();

        $wire = $crypto->encrypt('{"hello":"world"}', $key);
        $tampered = base64_encode('x'.substr(base64_decode(str_replace("\n", '', $wire)), 1));

        $this->assertNull($crypto->decrypt($tampered, $key));
    }
}

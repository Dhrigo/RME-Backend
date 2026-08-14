<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Central SaaS Server Configuration
    |--------------------------------------------------------------------------
    */
    'central_hub_url' => env('SAAS_CENTRAL_HUB_URL', 'https://hub.simgos.id'),
    'central_hub_timeout' => (int) env('SAAS_CENTRAL_HUB_TIMEOUT', 10),

    /*
    |--------------------------------------------------------------------------
    | RSA Public Key for Signature Verification (PEM Format)
    |--------------------------------------------------------------------------
    | The Central SaaS Server signs license tokens with its private key.
    | This public key verifies the authenticity of the signature locally.
    */
    'public_key' => env('SAAS_LICENSE_PUBLIC_KEY', null),
    'public_key_path' => env('SAAS_LICENSE_PUBLIC_KEY_PATH', storage_path('keys/saas_license_public.key')),

    /*
    |--------------------------------------------------------------------------
    | Webhook Secret
    |--------------------------------------------------------------------------
    | HMAC Secret used by Central SaaS Hub to push instant license/module updates.
    */
    'webhook_secret' => env('SAAS_WEBHOOK_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Offline Grace Period
    |--------------------------------------------------------------------------
    | Maximum days the application is allowed to run without phone-home verification.
    */
    'max_offline_days' => (int) env('SAAS_MAX_OFFLINE_DAYS', 14),

    /*
    |--------------------------------------------------------------------------
    | Hardware Binding Strictness
    |--------------------------------------------------------------------------
    | If true, requires exact hardware fingerprint match. If false (e.g. in test),
    | allows wildcard matching.
    */
    'strict_hardware_binding' => (bool) env('SAAS_STRICT_HWID', true),

    /*
    |--------------------------------------------------------------------------
    | Clock Tampering Detection
    |--------------------------------------------------------------------------
    | Checks monotonic timestamp watermark to prevent system clock rollback attacks.
    */
    'enable_clock_tamper_detection' => (bool) env('SAAS_CLOCK_CHECK', true),
];

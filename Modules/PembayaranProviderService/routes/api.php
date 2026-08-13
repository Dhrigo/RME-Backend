<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranProviderService\Http\Controllers\ProviderServiceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('provider-services', ProviderServiceController::class)
        ->parameters(['provider-services' => 'provider_service']);
});

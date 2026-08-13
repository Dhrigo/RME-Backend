<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranPaymentProvider\Http\Controllers\PaymentProviderController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('payment-providers', PaymentProviderController::class)
        ->parameters(['payment-providers' => 'payment_provider']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralReferralCode\Http\Controllers\ReferralCodeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('referral-codes', ReferralCodeController::class)->parameters(['referral-codes' => 'referral_code']);
});

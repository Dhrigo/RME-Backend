<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranReferral\Http\Controllers\ReferralController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('referrals', ReferralController::class)->only(['index', 'store', 'show', 'update']);
});

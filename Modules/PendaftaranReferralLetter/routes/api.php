<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranReferralLetter\Http\Controllers\ReferralLetterController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('referralletters', ReferralLetterController::class)->only(['index', 'store', 'show']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranReferral\Http\Controllers\PendaftaranReferralController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pendaftaranreferrals', PendaftaranReferralController::class)->names('pendaftaranreferral');
});

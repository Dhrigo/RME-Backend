<?php

use Illuminate\Support\Facades\Route;
use Modules\SystemLicenseGuard\Http\Controllers\LicenseController;

Route::prefix('v1/system/license')->group(function () {
    Route::get('/status', [LicenseController::class, 'status']);
    Route::get('/fingerprint', [LicenseController::class, 'fingerprint']);
    Route::post('/activate', [LicenseController::class, 'activate']);
    Route::post('/sync', [LicenseController::class, 'sync']);
    Route::post('/webhook', [LicenseController::class, 'webhook']);
});

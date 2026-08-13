<?php

use Illuminate\Support\Facades\Route;
use Modules\PegawaiPracticeLicense\Http\Controllers\PracticeLicenseController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('practice-licenses', PracticeLicenseController::class)->only(['index', 'store', 'show', 'update']);
});

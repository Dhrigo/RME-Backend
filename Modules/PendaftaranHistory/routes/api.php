<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranHistory\Http\Controllers\PendaftaranHistoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('registration-histories', PendaftaranHistoryController::class)
        ->parameters(['registration-histories' => 'history'])
        ->only(['index', 'store', 'show']);
});

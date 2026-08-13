<?php

use Illuminate\Support\Facades\Route;
use Modules\PenjaminRSDischargeMethod\Http\Controllers\DischargeMethodController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('discharge-methods', DischargeMethodController::class);
});
<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralKip\Http\Controllers\KipController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('kips', KipController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralKap\Http\Controllers\KapController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('kaps', KapController::class);
});

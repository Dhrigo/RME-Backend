<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWard\Http\Controllers\WardController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('wards', WardController::class);
});

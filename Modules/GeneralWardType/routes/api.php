<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWardType\Http\Controllers\WardTypeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ward-types', WardTypeController::class);
});

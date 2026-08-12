<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralIcdOTopography\Http\Controllers\IcdOTopographyController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('icd-o-topographies', IcdOTopographyController::class);
});

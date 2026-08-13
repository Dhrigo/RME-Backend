<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralIcdOMorphology\Http\Controllers\IcdOMorphologyController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('icd-o-morphologies', IcdOMorphologyController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPpk\Http\Controllers\PpkController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ppks', PpkController::class);
});

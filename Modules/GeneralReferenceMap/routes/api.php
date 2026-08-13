<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralReferenceMap\Http\Controllers\ReferenceMapController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('reference-maps', ReferenceMapController::class)->parameters(['reference-maps' => 'reference_map']);
});

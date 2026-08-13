<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordImageMarker\Http\Controllers\ImageMarkerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('image-markers', ImageMarkerController::class)
        ->parameters(['image-markers' => 'record']);
});

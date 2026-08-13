<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordImageMarkerPoint\Http\Controllers\ImageMarkerPointController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('image-marker-points', ImageMarkerPointController::class)
        ->parameters(['image-marker-points' => 'record']);
});

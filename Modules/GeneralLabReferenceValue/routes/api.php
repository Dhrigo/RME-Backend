<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralLabReferenceValue\Http\Controllers\LabReferenceValueController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-reference-values', LabReferenceValueController::class);
});

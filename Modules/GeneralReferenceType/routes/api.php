<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralReferenceType\Http\Controllers\ReferenceTypeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('reference-types', ReferenceTypeController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananBloodRequestItem\Http\Controllers\BloodRequestItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('blood-request-items', BloodRequestItemController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['blood-request-items' => 'record']);
});

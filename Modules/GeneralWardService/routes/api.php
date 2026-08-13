<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWardService\Http\Controllers\WardServiceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ward-services', WardServiceController::class)->parameters(['ward-services' => 'ward_service']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPackageService\Http\Controllers\PackageServiceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('package-services', PackageServiceController::class);
});

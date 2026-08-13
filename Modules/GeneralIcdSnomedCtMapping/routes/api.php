<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralIcdSnomedCtMapping\Http\Controllers\IcdSnomedCtMappingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('icd-snomed-ct-mappings', IcdSnomedCtMappingController::class);
});

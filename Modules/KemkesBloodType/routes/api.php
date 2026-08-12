<?php

use Illuminate\Support\Facades\Route;
use Modules\KemkesBloodType\Http\Controllers\BloodTypeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('blood_types', BloodTypeController::class);
});

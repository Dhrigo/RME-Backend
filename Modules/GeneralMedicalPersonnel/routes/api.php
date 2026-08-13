<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralMedicalPersonnel\Http\Controllers\MedicalPersonnelController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medical-personnel', MedicalPersonnelController::class);
});
